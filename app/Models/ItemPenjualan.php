<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemPenjualan extends Model
{
    use HasFactory;

    protected $table = 'item_penjualans';
    protected $primaryKey = 'id_item_penjualan';
    protected $fillable = [
        'id_penjualan',
        'id_kambing',
        'status',
    ];

    protected $foreignKey = ['id_penjualan', 'id_kambing'];

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class, 'id_penjualan', 'id_penjualan');
    }

    public function kambing()
    {
        return $this->belongsTo(Kambing::class, 'id_kambing', 'id_kambing');
    }
}
