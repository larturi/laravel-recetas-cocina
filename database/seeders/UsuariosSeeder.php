<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Leandro Arturi',
            'email' => 'lea.arturi@gmail.com',
            'password' => Hash::make('12345678'),
            'url' => 'http://leandroarturi.com,ar',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('users')->insert([
            'name' => 'Candelaria',
            'email' => 'cande@gmail.com',
            'password' => Hash::make('12345678'),
            'url' => 'http://candelaria.com,ar',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('users')->insert([
            'name' => 'Lisandro',
            'email' => 'lisandro@gmail.com',
            'password' => Hash::make('12345678'),
            'url' => 'http://lisandro.com,ar',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
