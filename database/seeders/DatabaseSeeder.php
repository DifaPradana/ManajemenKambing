<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */

    public function run(): void
    {
        DB::table('admin')->insert([
            'username' => 'Difa',
            'password' => bcrypt('asdasdasd'),
            'is_admin' => true,
            'created_at' => Date::now(),
            'updated_at' => Date::now(),
        ]);

        DB::table('suppliers')->insert([
            'nama_supplier' => 'PT. Kambing',
            'alamat' => 'Jl. Kambing No. 1',
            'telp' => '081234567890',
            'jenis_supplier' => 'Kambing',
            'created_at' => Date::now(),
            'updated_at' => Date::now(),
        ]);

        DB::table('jenis_kambings')->insert([
            'jenis_kambing' => 'Kambing Jawa',
            'created_at' => Date::now(),
            'updated_at' => Date::now(),
        ]);

        DB::table('kategori_kambings')->insert([
            'nama_kategori' => 'Kambing Potong',
            'biaya_operasional' => 100000,
            'created_at' => Date::now(),
            'updated_at' => Date::now(),
        ]);
    }
}
