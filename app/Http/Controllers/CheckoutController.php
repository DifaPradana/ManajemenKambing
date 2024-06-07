<?php

namespace App\Http\Controllers;

use App\Models\ItemPenjualan;
use App\Models\Kambing;
use App\Models\Pelanggan;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function checkoutView($id)
    {
        $data = [
            'title' => 'Checkout',
            'penjualan' => Penjualan::find($id),
            'pelanggan' => Pelanggan::all(),
        ];
        return view('admin.checkout', $data);
    }

    public function checkout(Request $request, $id)
    {
        $penjualan = Penjualan::find($id);
        $penjualan->id_pelanggan = $request->id_pelanggan;
        $penjualan->status = 'Selesai';
        $penjualan->save();

        $itemPenjualan = ItemPenjualan::where('id_penjualan', $id)->get();
        foreach ($itemPenjualan as $item) {
            $item->status = 1;
            $item->save();

            // Update the status of the kambing to 'Terjual'
            $kambing = Kambing::find($item->id_kambing);
            if ($kambing) {
                $kambing->status = 'Terjual';
                $kambing->save();
            }
        }


        return redirect()->route('form-penjualan')->with('success', 'Checkout Berhasil');
    }
}
