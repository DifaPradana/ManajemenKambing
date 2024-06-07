<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataKambingAwal extends Model
{
    use HasFactory;

    protected $table = 'data_kambing_awals';
    protected $primaryKey = 'id_data_kambing_awal'; // Correct primary key column name
    public $incrementing = true; // Primary key is auto-incrementing
    protected $keyType = 'int'; // Primary key is of type integer
    protected $fillable = [
        'id_kambing',
        'berat_badan_awal',
        'tinggi_badan_awal',
        'poel_awal',
    ];
    protected $foreignKeys = [
        'id_kambing',
    ];



    public function kambing()
    {
        return $this->belongsTo(Kambing::class, 'id_kambing');
    }
}
