<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\DataKambingAkhir;
use App\Models\DataKambingAwal;
use App\Models\JenisKambing;
use App\Models\Kambing;
use App\Models\KategoriKambing;
use App\Models\Penerimaan;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DataKambingController extends Controller
{
    public function index()
    {
        $data = array(
            'title' => 'Data Kambing',
            'datakambing' => Kambing::with('kategoriKambing')->get(),
            'penerimaan' => Penerimaan::all(),
            'kambingawal' => DataKambingAwal::all(),
            'kambingakhir' => DataKambingAkhir::all(),
        );
        return view('admin.data-kambing', $data);
    }


    public function indexUpdate()
    {
        $data = array(
            'title' => 'Input Data Kambing Yang Diterima',
            'penerimaan' => Penerimaan::with('Admin', 'Supplier')->get(),
            'supplier' => Supplier::all(),
            'admin' => Admin::all(),
            'datakambing' => Kambing::all(),
        );
        return view('admin.penerimaan-input', $data);
    }

    public function indexUpdateAkhir()
    {
        $data = array(
            'title' => 'Input Data Kambing Akhir',
            'penerimaan' => Penerimaan::with('Admin', 'Supplier')->get(),
            'supplier' => Supplier::all(),
            'admin' => Admin::all(),
            'datakambing' => Kambing::all(),
        );
        return view('admin.input-data-akhir', $data);
    }

    public function showByPenerimaan($id)
    {
        $penerimaan = Penerimaan::find($id);


        if (!$penerimaan) {
            return redirect()->route('penerimaan')->with('error', 'Penerimaan tidak ditemukan');
        }

        $data = array(
            'title' => 'Data Kambing Berdasarkan Penerimaan',
            'penerimaan' => $penerimaan,
            'datakambing' => Kambing::where('id_penerimaan', $penerimaan->id_penerimaan)->get(),
            'jenis' => JenisKambing::all(),
            'kategori' => KategoriKambing::all(),
        );

        return view('admin.form-kambing', $data);
    }

    public function updateView($id)
    {
        $penerimaan = Penerimaan::with('Admin', 'Supplier')->find($id);
        $jenis = JenisKambing::all();
        $kategori = KategoriKambing::all();
        $kambing = Kambing::where('id_penerimaan', $id)->get();
        $kambingawal = DataKambingAwal::all();

        $data = array(
            'title' => 'Input Data Penerimaan',
            'penerimaan' => $penerimaan,
            'jenis' => $jenis,
            'kategori' => $kategori,
            'kambing' => $kambing,
            'kambingawal' => $kambingawal,
        );
        return view('admin.form-kambing-update', $data);
    }



    public function updateAkhirView($id)
    {
        $penerimaan = Penerimaan::with('Admin', 'Supplier')->find($id);
        $jenis = JenisKambing::all();
        $kategori = KategoriKambing::all();
        $kambing = Kambing::where('id_penerimaan', $id)->get();
        $kambingakhir = DataKambingAkhir::where('id_kambing', $id)->get();

        $data = array(
            'title' => 'Input Data Akhir',
            'penerimaan' => $penerimaan,
            'jenis' => $jenis,
            'kategori' => $kategori,
            'kambing' => $kambing,
            'kambingakhir' => $kambingakhir,
        );
        return view('admin.form-kambing-akhir', $data);
    }


    public function create(Request $request)
    {
        $request->validate([
            'kode_kambing' => 'required|array',
            'kode_kambing.*' => 'required|string',
            'umur' => 'required|array',
            'umur.*' => 'required|integer|min:0',
            'jenis_kelamin' => 'required|array',
            'jenis_kelamin.*' => 'required|string',
            'harga_beli' => 'nullable|array',
            'harga_beli.*' => 'nullable|integer|min:0',
            'status' => 'required|array',
            'status.*' => 'required|in:Masuk,Penggemukan,Siap Jual,Terjual',
            'berat_badan_awal' => 'required|array',
            'berat_badan_awal.*' => 'required|integer|min:0',
            'tinggi_badan_awal' => 'required|array',
            'tinggi_badan_awal.*' => 'required|integer|min:0',
            'poel_awal' => 'required|array',
            'poel_awal.*' => 'required|integer|min:0',
            'id_penerimaan' => 'required|integer',
            'id_jenis_kambing.*' => 'required|integer',
            'id_kategori_kambing.*' => 'required|integer',
        ]);

        $kodeKambing = $request->input('kode_kambing');
        $jenisKelamin = $request->input('jenis_kelamin');
        $umurHewan = $request->input('umur');
        $status = $request->input('status');
        $hargaBeli = $request->input('harga_beli');
        $idPenerimaan = $request->input('id_penerimaan');
        $beratBadanAwal = $request->input('berat_badan_awal');
        $tinggiBadanAwal = $request->input('tinggi_badan_awal');
        $poelAwal = $request->input('poel_awal');
        $idJenisKambing = $request->input('id_jenis_kambing');
        $idKategoriKambing = $request->input('id_kategori_kambing');

        // Retrieve jumlah_penerimaan for the given id_penerimaan
        $penerimaan = Penerimaan::find($idPenerimaan);
        if (!$penerimaan) {
            return redirect()->route('data-kambing-awal')->with('error', 'The specified penerimaan does not exist.');
        }

        $jumlahPenerimaan = $penerimaan->total_penerimaan;

        // Count existing kambing records for the given id_penerimaan
        $existingKambingCount = Kambing::where('id_penerimaan', $idPenerimaan)->count();

        // Calculate the remaining capacity
        $remainingCapacity = $jumlahPenerimaan - $existingKambingCount;

        // Check if the new kambing count exceeds the remaining capacity
        if (count($kodeKambing) > $remainingCapacity) {
            return redirect()->route('data-kambing-awal')->with('error', 'Kamu melebihi kapasitas penerimaan. Silakan cek kembali jumlah kambing yang akan dimasukkan.');
        }

        // Prepare data for kambing table
        $kambingData = [];
        for ($i = 0; $i < count($kodeKambing); $i++) {
            // Retrieve biaya_operasional for the given id_kategori_kambing
            $kategoriKambing = KategoriKambing::find($idKategoriKambing[$i]);
            $biayaOperasional = $kategoriKambing ? $kategoriKambing->biaya_operasional : 0;

            // Calculate harga_jual
            $hargaJual = $hargaBeli[$i] + $biayaOperasional;

            $kambingData[] = [
                'kode_kambing' => $kodeKambing[$i],
                'id_jenis_kambing' => $idJenisKambing[$i],
                'id_kategori_kambing' => $idKategoriKambing[$i],
                'umur' => $umurHewan[$i],
                'jenis_kelamin' => $jenisKelamin[$i],
                'status' => $status[$i],
                'harga_beli' => $hargaBeli[$i],
                'id_penerimaan' => $idPenerimaan,
                'harga_jual' => $hargaJual, // Calculated value for harga_jual
                'created_at' => DB::raw('NOW()'),
                'updated_at' => DB::raw('NOW()'),
            ];
        }

        // Insert data into kambing table
        Kambing::insert($kambingData);

        // Get the last inserted IDs for kambing table
        $lastInsertedIds = Kambing::latest()->take(count($kodeKambing))->pluck('id_kambing')->toArray();

        // Check if the count of inserted kambing matches the input count
        if (count($lastInsertedIds) != count($kodeKambing)) {
            return redirect()->back()->with('error', 'Error inserting kambing data.');
        }

        // Prepare data for data_kambing_awals table
        $dataKambingAwalsData = [];
        for ($i = 0; $i < count($kodeKambing); $i++) {
            $dataKambingAwalsData[] = [
                'id_kambing' => $lastInsertedIds[$i],
                'berat_badan_awal' => $beratBadanAwal[$i],
                'tinggi_badan_awal' => $tinggiBadanAwal[$i],
                'poel_awal' => $poelAwal[$i],
                'created_at' => DB::raw('NOW()'),
                'updated_at' => DB::raw('NOW()'),
            ];
        }

        // Insert data into data_kambing_awals table
        DataKambingAwal::insert($dataKambingAwalsData);

        $dataKambingAkhirData = [];
        for ($i = 0; $i < count($kodeKambing); $i++) {
            $dataKambingAkhirData[] = [
                'id_kambing' => $lastInsertedIds[$i],
                'berat_badan_akhir' => null,
                'tinggi_badan_akhir' => null,
                'poel_akhir' => null,
                'created_at' => DB::raw('NOW()'),
                'updated_at' => DB::raw('NOW()'),
            ];
        }

        DataKambingAkhir::insert($dataKambingAkhirData);

        return redirect()->route('penerimaan')->with('success', 'Data kambing berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_kambing' => 'required|array',
            'kode_kambing.*' => 'required|string',
            'umur' => 'required|array',
            'umur.*' => 'required|integer|min:0',
            'jenis_kelamin' => 'required|array',
            'jenis_kelamin.*' => 'required|string',
            'harga_beli' => 'nullable|array',
            'harga_beli.*' => 'nullable|integer|min:0',
            'status' => 'required|array',
            'status.*' => 'required|in:Masuk,Penggemukan,Siap Jual,Terjual',
            'berat_badan_awal' => 'required|array',
            'berat_badan_awal.*' => 'required|integer|min:0',
            'tinggi_badan_awal' => 'required|array',
            'tinggi_badan_awal.*' => 'required|integer|min:0',
            'poel_awal' => 'required|array',
            'poel_awal.*' => 'required|integer|min:0',

            'id_penerimaan' => 'required|integer',
            'id_jenis_kambing.*' => 'required|integer',
            'id_kategori_kambing.*' => 'required|integer',
        ]);

        $kodeKambing = $request->input('kode_kambing');
        $jenisKelamin = $request->input('jenis_kelamin');
        $umurHewan = $request->input('umur');
        $status = $request->input('status');
        $hargaBeli = $request->input('harga_beli');
        $idPenerimaan = $request->input('id_penerimaan');
        $beratBadanAwal = $request->input('berat_badan_awal');
        $tinggiBadanAwal = $request->input('tinggi_badan_awal');
        $poelAwal = $request->input('poel_awal');

        $idJenisKambing = $request->input('id_jenis_kambing');
        $idKategoriKambing = $request->input('id_kategori_kambing');

        // Retrieve jumlah_penerimaan for the given id_penerimaan
        $penerimaan = Penerimaan::find($idPenerimaan);
        if (!$penerimaan) {
            return redirect()->route('data-kambing-awal')->with('error', 'The specified penerimaan does not exist.');
        }

        // Update existing kambing records
        for ($i = 0; $i < count($kodeKambing); $i++) {
            $kambing = Kambing::where('id_penerimaan', $idPenerimaan)
                ->where('kode_kambing', $kodeKambing[$i])
                ->first();

            $kategoriKambing = KategoriKambing::find($idKategoriKambing[$i]);
            $biayaOperasional = $kategoriKambing ? $kategoriKambing->biaya_operasional : 0;

            // Calculate harga_jual
            $hargaJual = $hargaBeli[$i] + $biayaOperasional;

            if ($kambing) {
                $kambing->update([
                    'id_jenis_kambing' => $idJenisKambing[$i],
                    'id_kategori_kambing' => $idKategoriKambing[$i],
                    'umur' => $umurHewan[$i],
                    'jenis_kelamin' => $jenisKelamin[$i],
                    'status' => $status[$i],
                    'harga_beli' => $hargaBeli[$i],
                    'harga_jual' => $hargaJual,
                ]);

                // Update data_kambing_awals table
                $dataKambingAwal = DataKambingAwal::where('id_kambing', $kambing->id_kambing)->first();
                if ($dataKambingAwal) {
                    $dataKambingAwal->update([
                        'berat_badan_awal' => $beratBadanAwal[$i],
                        'tinggi_badan_awal' => $tinggiBadanAwal[$i],
                        'poel_awal' => $poelAwal[$i],
                    ]);
                }
            } else {
                // Handle case where kambing does not exist
                return redirect()->route('data-kambing-awal')->with('error', 'Kambing dengan kode ' . $kodeKambing[$i] . ' tidak ditemukan.');
            }
        }

        return redirect()->route('data-kambing-awal')->with('success', 'Data kambing berhasil diperbarui.');
    }

    public function updateAkhir(Request $request, $id)
    {
        $request->validate([
            'kode_kambing' => 'required|array',
            'kode_kambing.*' => 'required|string',
            'umur' => 'required|array',
            'umur.*' => 'required|integer|min:0',
            'jenis_kelamin' => 'required|array',
            'jenis_kelamin.*' => 'required|string',
            'harga_beli' => 'nullable|array',
            'harga_beli.*' => 'nullable|integer|min:0',
            'status' => 'required|array',
            'status.*' => 'required|in:Masuk,Penggemukan,Siap Jual,Terjual',
            'berat_badan_akhir' => 'required|array',
            'berat_badan_akhir.*' => 'required|integer|min:0',
            'tinggi_badan_akhir' => 'required|array',
            'tinggi_badan_akhir.*' => 'required|integer|min:0',
            'poel_akhir' => 'required|array',
            'poel_akhir.*' => 'required|integer|min:0',
            'id_penerimaan' => 'required|integer',
            'id_jenis_kambing.*' => 'required|integer',
            'id_kategori_kambing.*' => 'required|integer',
        ]);

        $kodeKambing = $request->input('kode_kambing');
        $jenisKelamin = $request->input('jenis_kelamin');
        $umurHewan = $request->input('umur');
        $status = $request->input('status');
        $hargaBeli = $request->input('harga_beli');
        $idPenerimaan = $request->input('id_penerimaan');
        $beratBadanAkhir = $request->input('berat_badan_akhir');
        $tinggiBadanAkhir = $request->input('tinggi_badan_akhir');
        $poelAkhir = $request->input('poel_akhir');

        $idJenisKambing = $request->input('id_jenis_kambing');
        $idKategoriKambing = $request->input('id_kategori_kambing');

        // Retrieve jumlah_penerimaan for the given id_penerimaan
        $penerimaan = Penerimaan::find($idPenerimaan);
        if (!$penerimaan) {
            return redirect()->route('data-kambing-awal')->with('error', 'The specified penerimaan does not exist.');
        }

        // Update existing kambing records
        for ($i = 0; $i < count($kodeKambing); $i++) {
            $kambing = Kambing::where('id_penerimaan', $idPenerimaan)
                ->where('kode_kambing', $kodeKambing[$i])
                ->first();

            $kategoriKambing = KategoriKambing::find($idKategoriKambing[$i]);
            $biayaOperasional = $kategoriKambing ? $kategoriKambing->biaya_operasional : 0;

            // Calculate harga_jual
            $hargaJual = $hargaBeli[$i] + $biayaOperasional;

            if ($kambing) {
                $kambing->update([
                    'id_jenis_kambing' => $idJenisKambing[$i],
                    'id_kategori_kambing' => $idKategoriKambing[$i],
                    'umur' => $umurHewan[$i],
                    'jenis_kelamin' => $jenisKelamin[$i],
                    'status' => $status[$i],
                    'harga_beli' => $hargaBeli[$i],
                    'harga_jual' => $hargaJual,
                ]);

                // Update data_kambing_awals table
                $dataKambingAkhir = DataKambingAkhir::where('id_kambing', $kambing->id_kambing)->first();
                if ($dataKambingAkhir) {
                    $dataKambingAkhir->update([
                        'berat_badan_akhir' => $beratBadanAkhir[$i],
                        'tinggi_badan_akhir' => $tinggiBadanAkhir[$i],
                        'poel_akhir' => $poelAkhir[$i],
                    ]);
                }
            } else {
                // Handle case where kambing does not exist
                return redirect()->route('data-kambing-awal')->with('error', 'Kambing dengan kode ' . $kodeKambing[$i] . ' tidak ditemukan.');
            }
        }

        return redirect()->route('data-kambing-awal')->with('success', 'Data kambing berhasil diperbarui.');
    }





    public function destroy($id)
    {
        $datakambing = Kambing::find($id);

        if (!$datakambing) {
            return abort(404);
        }

        $datakambing->delete();

        session()->flash('success', 'Data kambing berhasil dihapus!');
        return redirect()->route('data-kambing');
    }


    public function destroyDataKambing($id)
    {
        $datakambing = Kambing::find($id);
        $datakambingawal = DataKambingAwal::where('id_kambing', $id)->first();

        if (!$datakambing) {
            return abort(404);
        }

        $datakambingawal->delete();
        $datakambing->delete();

        session()->flash('success', 'Data kambing berhasil dihapus!');
        return redirect()->back();
    }






    //


}
