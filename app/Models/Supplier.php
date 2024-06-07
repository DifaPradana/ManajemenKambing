<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $table = 'suppliers';
    protected $primaryKey = 'id_supplier';
    protected $fillable = [
        'nama_supplier',
        'alamat',
        'telp',
        'jenis_supplier',
    ];


    public function penerimaan()
    {
        return $this->hasMany(Penerimaan::class, 'id_supplier');
    }
}
