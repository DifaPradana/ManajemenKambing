<?php

namespace App\Http\Controllers;

use App\Models\DetailPenjualan;
use App\Models\ItemPenjualan;
use App\Models\Kambing;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenjualanController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Penjualan',
            'penjualan' => Penjualan::where('status', 'Selesai')->get(),
        ];
        return view('admin.data-penjualan', $data);
    }

    public function form()
    {
        $userId = Auth::user()->id_admin;

        $penjualan = Penjualan::where('status', 'Belum Selesai')->where('id_admin', $userId)->latest()->first();
        $totalHarga = 0;
        if ($penjualan) {
            $totalHarga = $penjualan->total_harga;
        }

        $data = array(
            'title' => 'Form Penjualan',
            'penjualan' => Penjualan::where('status', 'Belum Selesai')->where('id_admin', $userId)->latest()->first(),
            'kambing' => Kambing::where('status', 'Siap Jual')->get(),
            'item_penjualan' => ItemPenjualan::where('status', 0)->get(),
            'total_harga' => $totalHarga
        );
        return view('admin.form-penjualan', $data);
    }

    public function create(Request $request)
    {
        $userId = Auth::user()->id_admin;

        // Validasi input form
        $request->validate([
            'id_kambing' => 'required|exists:kambings,id_kambing',
        ]);

        // Cari kambing berdasarkan id_kambing
        $kambing = Kambing::find($request->id_kambing);

        if (!$kambing || $kambing->status != 'Siap Jual') {
            return redirect()->route('form-penjualan')->with('error', 'Kambing Tidak Siap Jual atau tidak ditemukan.');
        }

        // Cari penjualan yang belum selesai
        $penjualan = Penjualan::where('status', 'Belum Selesai')->where('id_admin', $userId)->latest()->first();

        // Jika tidak ditemukan penjualan yang belum selesai, buat penjualan baru
        if (!$penjualan) {
            $penjualan = Penjualan::create([
                'id_admin' => $userId,
                'id_pelanggan' => $request->id_pelanggan,
                'total_harga' => 0,
                'status' => 'Belum Selesai',
            ]);
        }

        ItemPenjualan::create([
            'id_penjualan' => $penjualan->id_penjualan,
            'id_kambing' => $kambing->id_kambing,
            'status' => 0,
        ]);

        $totalharga = ItemPenjualan::where('id_penjualan', $penjualan->id_penjualan)
            ->join('kambings', 'item_penjualans.id_kambing', '=', 'kambings.id_kambing')
            ->sum('kambings.harga_jual');

        // Update the penjualan with the new total_harga
        $penjualan->total_harga = $totalharga;
        $penjualan->save();



        return redirect()->back()->with('success', 'Kambing berhasil ditambahkan ke penjualan.');
    }


    public function destroy($id)
    {
        $itemPenjualan = ItemPenjualan::find($id);

        if (!$itemPenjualan) {
            return redirect()->route('data-penjualan')->with('error', 'Penjualan tidak ditemukan.');
        }

        // Get the associated Penjualan
        $penjualan = Penjualan::find($itemPenjualan->id_penjualan);

        // Delete the ItemPenjualan
        $itemPenjualan->delete();

        // Recalculate total_harga
        $totalHarga = ItemPenjualan::where('id_penjualan', $penjualan->id_penjualan)
            ->join('kambings', 'item_penjualans.id_kambing', '=', 'kambings.id_kambing')
            ->sum('kambings.harga_jual');

        // Update the total_harga in the Penjualan record
        $penjualan->total_harga = $totalHarga;
        $penjualan->save();

        return redirect()->back()->with('success', 'Penjualan berhasil dihapus dan total harga diperbarui.');
    }
}
