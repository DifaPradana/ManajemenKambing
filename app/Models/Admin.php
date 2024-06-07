<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class Admin extends Model implements Authenticatable
{
    use AuthenticableTrait;

    protected $primaryKey = 'id_admin';


    protected $table = 'admin'; // Sesuaikan dengan nama tabel Anda

    protected $fillable = [
        'username',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    public function getAuthIdentifierName()
    {
        return 'username'; // Sesuaikan dengan nama kolom yang digunakan sebagai identifier
    }

    public function getAuthIdentifier()
    {
        return $this->{$this->getAuthIdentifierName()};
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function Penerimaan()
    {
        return $this->hasMany(Penerimaan::class, 'id_admin');
    }
}
