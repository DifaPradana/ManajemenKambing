<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Penerimaan;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon; // Include Carbon for date handling

class PenerimaanController extends Controller
{
    public function index()
    {
        $data = array(
            'title' => 'Data Penerimaan',
            'penerimaan' => Penerimaan::with('Admin', 'Supplier')->get(),
            'supplier' => Supplier::all(),
            'admin' => Admin::all(),
        );
        return view('admin.penerimaan', $data);
    }


    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tanggal_penerimaan' => 'required|date',
            'total_penerimaan' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        // Get the currently logged-in admin's ID
        $admin = Auth::user(); // Assuming the admin model is named User
        $id_admin = $admin->id_admin;

        // Convert the date from dd/mm/yyyy to YYYY-MM-DD using Carbon
        $formattedDate = Carbon::createFromFormat('d-m-Y', $request->tanggal_penerimaan)->format('Y-m-d');

        // Set timezone to WIB (Waktu Indonesia Barat)
        $currentTime = Carbon::now('Asia/Jakarta')->format('H:i:s');

        // Concatenate formattedDate and currentTime to get full datetime
        $fullDateTime = $formattedDate . ' ' . $currentTime;

        // Create an array of data to be inserted into the database
        $data = [
            'tanggal_penerimaan' => $fullDateTime,
            'total_penerimaan' => $request->total_penerimaan,
            'id_admin' => $id_admin,
            'id_supplier' => $request->id_supplier,
        ];

        // Insert the data into the database
        Penerimaan::create($data);

        return redirect()->back()->with('success', 'Data penerimaan berhasil ditambahkan.');
    }


    public function update(Request $request, $id)
    {
        // Find the penerimaan by id
        $penerimaan = Penerimaan::find($id);

        // Check if the penerimaan exists
        if (!$penerimaan) {
            return abort(404);
        }

        // Validate the request data
        $validator = Validator::make($request->all(), [
            'tanggal_penerimaan' => 'required|date_format:d-m-Y',
            'total_penerimaan' => 'required|integer|min:0',
            'id_supplier' => 'required',
        ]);

        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $admin = Auth::user(); // Assuming the admin model is named User
        $id_admin = $admin->id_admin;

        // Get the original date and time from the penerimaan and convert it to a Carbon instance
        $originalDateTime = Carbon::parse($penerimaan->tanggal_penerimaan);

        // Convert the date from dd/mm/yyyy to YYYY-MM-DD using Carbon
        $formattedDate = Carbon::createFromFormat('d-m-Y', $request->tanggal_penerimaan)->format('Y-m-d');

        // Combine the updated date with the original time
        $updatedDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $formattedDate . ' ' . $originalDateTime->format('H:i:s'));

        // Update the penerimaan data
        $penerimaan->tanggal_penerimaan = $updatedDateTime;
        $penerimaan->total_penerimaan = $request->total_penerimaan;
        $penerimaan->id_admin = $id_admin;
        $penerimaan->id_supplier = $request->id_supplier;
        $penerimaan->save();

        // Flash success message
        session()->flash('success', 'Data penerimaan berhasil diubah!');

        // Redirect to the index page
        return redirect()->route('penerimaan');
    }




    public function destroy($id)
    {
        // Find penerimaan by id
        $penerimaan = Penerimaan::find($id);

        // Check if penerimaan exists
        if (!$penerimaan) {
            return abort(404);
        }

        // Delete penerimaan
        $penerimaan->delete();

        // Flash success message
        session()->flash('hapus_success', 'Data penerimaan berhasil dihapus!');

        // Redirect to index page
        return redirect()->route('penerimaan');
    }
}
