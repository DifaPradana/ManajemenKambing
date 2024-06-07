<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataKambingAkhir extends Model
{
    use HasFactory;

    protected $table = 'data_kambing_akhirs';
    protected $primaryKey = 'id_data_kambing_akhir'; // Correct primary key column name
    public $incrementing = true; // Primary key is auto-incrementing
    protected $keyType = 'int'; // Primary key is of type integer
    protected $fillable = [
        'id_kambing',
        'berat_badan_akhir',
        'tinggi_badan_akhir',
        'poel_akhir',
    ];
    protected $foreignKeys = [
        'id_kambing',
    ];

    public function kambing()
    {
        return $this->belongsTo(Kambing::class, 'id_kambing');
    }
}
