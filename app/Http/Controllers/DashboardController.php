<?php

namespace App\Http\Controllers;

use App\Models\Kambing;
use App\Models\Penjualan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {

        Carbon::setLocale('id');

        $data = [
            'title' => 'Dashboard',
            'penjualan' => Penjualan::where('status', 'Selesai')->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()]),
            'current_month' => Carbon::now()->translatedFormat('F'),

            'kambing' => Kambing::where('status', 'Siap Jual'),
            'penggemukan' => Kambing::where('status', 'Penggemukan'),
        ];

        return view('admin.dashboard',  $data);
    }
}
