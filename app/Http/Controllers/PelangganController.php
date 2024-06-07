<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index()
    {
        $data = [
            'pelanggan' => Pelanggan::all(),
            'title' => 'Data Pelanggan',
        ];
        return view('admin.pelanggan', $data);
    }

    public function create(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'alamat' => 'required|string',
            'telp' => 'required|string',
        ]);

        $data = [
            'nama_pelanggan' => $request->nama_pelanggan,
            'alamat' => $request->alamat,
            'telp' => $request->telp,
        ];

        Pelanggan::create($data);

        return redirect()->back()->with('success', 'Data pelanggan berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'alamat' => 'required|string',
            'telp' => 'required|string',
        ]);

        $data = [
            'nama_pelanggan' => $request->nama_pelanggan,
            'alamat' => $request->alamat,
            'telp' => $request->telp,
        ];

        Pelanggan::where('id_pelanggan', $id)->update($data);

        return redirect()->back()->with('success', 'Data pelanggan berhasil diubah.');
    }

    public function destroy($id)
    {
        Pelanggan::destroy($id);

        return redirect()->back()->with('success', 'Data pelanggan berhasil dihapus.');
    }
}
