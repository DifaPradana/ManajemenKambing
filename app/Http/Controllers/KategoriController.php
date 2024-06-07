<?php

namespace App\Http\Controllers;

use App\Models\KategoriKambing;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Kategori Kambing',
            'kategori' => KategoriKambing::all(),

        ];
        return view('admin.kategori', $data);
    }

    public function create(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required',
            'biaya_operasional' => 'required'
        ]);

        KategoriKambing::create([
            'nama_kategori' => $request->nama_kategori,
            'biaya_operasional' => $request->biaya_operasional
        ]);

        return redirect()->back()->with('success', 'Kategori berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required',
            'biaya_operasional' => 'required'
        ]);

        KategoriKambing::find($id)->update([
            'nama_kategori' => $request->nama_kategori,
            'biaya_operasional' => $request->biaya_operasional
        ]);

        return redirect()->back()->with('success', 'Kategori berhasil diubah');
    }

    public function destroy($id)
    {
        KategoriKambing::find($id)->delete();
        return redirect()->back()->with('success', 'Kategori berhasil dihapus');
    }
}
