<?php

namespace App\Http\Controllers;

use App\Models\JenisKambing;
use Illuminate\Http\Request;

class JenisController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Jenis Kambing',
            'jenis' => JenisKambing::all(),

        ];
        return view('admin.jenis', $data);
    }

    public function create(Request $request)
    {
        $request->validate([
            'jenis_kambing' => 'required',
        ]);

        JenisKambing::create([
            'jenis_kambing' => $request->jenis_kambing,
        ]);

        return redirect()->back()->with('success', 'Jenis berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis_kambing' => 'required',
        ]);

        JenisKambing::find($id)->update([
            'jenis_kambing' => $request->jenis_kambing,
        ]);

        return redirect()->back()->with('success', 'Jenis berhasil diubah');
    }

    public function destroy($id)
    {
        JenisKambing::find($id)->delete();
        return redirect()->back()->with('success', 'Jenis berhasil dihapus');
    }
}
