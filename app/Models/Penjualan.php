<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $table = 'penjualans';
    protected $primaryKey = 'id_penjualan';
    protected $fillable = [
        'id_admin',
        'id_pelanggan',
        'total_harga',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'id_admin', 'id_admin');
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan', 'id_pelanggan');
    }

    public function detailPenjualan()
    {
        return $this->hasMany(ItemPenjualan::class, 'id_penjualan', 'id_penjualan');
    }
}
