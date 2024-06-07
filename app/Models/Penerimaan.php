<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penerimaan extends Model
{
    use HasFactory;

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'id_admin');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'id_supplier');
    }

    public function Kambing()
    {
        return $this->hasMany(Kambing::class);
    }

    protected $table = 'penerimaans';
    protected $primaryKey = 'id_penerimaan';
    protected $fillable = [
        'tanggal_penerimaan',
        'total_penerimaan',
        'id_admin',
        'id_supplier',
    ];
    protected $foreignKeys = [
        'id_admin',
        'id_supplier',
    ];
}
