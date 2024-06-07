<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisKambing extends Model
{
    use HasFactory;

    protected $table = 'jenis_kambings';
    protected $primaryKey = 'id_jenis_kambing';
    protected $fillable = [
        'jenis_kambing',
    ];

    public function kambing()
    {
        return $this->hasMany(Kambing::class, 'id_jenis_kambing', 'id_jenis_kambing');
    }

    public function penerimaan()
    {
        return $this->hasMany(Penerimaan::class, 'id_jenis_kambing', 'id_jenis_kambing');
    }
}
