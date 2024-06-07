<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $data = [
            'supplier' => Supplier::all(),
            'title' => 'Data Supplier',
        ];
        return view('admin.supplier', $data);
    }

    public function create(Request $request)
    {
        $request->validate([
            'nama_supplier' => 'required|string|max:255',
            'alamat' => 'required|string',
            'telp' => 'required|string',
            'jenis_supplier' => 'required|string',
        ]);

        $data = [
            'nama_supplier' => $request->nama_supplier,
            'alamat' => $request->alamat,
            'telp' => $request->telp,
            'jenis_supplier' => $request->jenis_supplier,
        ];

        Supplier::create($data);

        return redirect()->back()->with('success', 'Data supplier berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_supplier' => 'required|string|max:255',
            'alamat' => 'required|string',
            'telp' => 'required|string',
            'jenis_supplier' => 'required|string',
        ]);

        $data = [
            'nama_supplier' => $request->nama_supplier,
            'alamat' => $request->alamat,
            'telp' => $request->telp,
            'jenis_supplier' => $request->jenis_supplier,
        ];

        Supplier::where('id_supplier', $id)->update($data);

        return redirect()->back()->with('success', 'Data supplier berhasil diubah.');
    }

    public function destroy($id)
    {
        Supplier::destroy($id);

        return redirect()->back()->with('success', 'Data supplier berhasil dihapus.');
    }
}
