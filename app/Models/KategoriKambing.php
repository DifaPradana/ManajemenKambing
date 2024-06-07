<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriKambing extends Model
{
    use HasFactory;

    protected $table = 'kategori_kambings';
    protected $primaryKey = 'id_kategori_kambing';
    protected $fillable = ['nama_kategori', 'biaya_operasional'];

    public function kambing()
    {
        return $this->hasMany(Kambing::class, 'id_kategori_kambing');
    }
}
