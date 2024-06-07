<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kambing extends Model
{
    use HasFactory;

    protected $table = 'kambings';
    protected $primaryKey = 'id_kambing';
    protected $fillable = [
        'kode_kambing',
        'id_jenis_kambing',
        'id_kategori_kambing',
        'umur',
        'jenis_kelamin',
        'harga_beli',
        'id_penerimaan',
        'status',
        'harga_jual',
    ];
    protected $foreignKey = ['id_jenis_kambing', 'id_kategori_kambing', 'id_penerimaan'];

    public function dataKambingAwal()
    {
        return $this->hasOne(DataKambingAwal::class, 'id_kambing');
    }

    public function dataKambingAkhir()
    {
        return $this->hasOne(DataKambingAkhir::class, 'id_kambing');
    }

    public function kategoriKambing()
    {
        return $this->belongsTo(KategoriKambing::class, 'id_kategori_kambing');
    }

    public function jenisKambing()
    {
        return $this->belongsTo(JenisKambing::class, 'id_jenis_kambing');
    }

    public function penerimaan()
    {
        return $this->belongsTo(Penerimaan::class);
    }

    public function itemPenjualan()
    {
        return $this->hasMany(ItemPenjualan::class, 'id_kambing');
    }
}
