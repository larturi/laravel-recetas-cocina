<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use Faker\Factory as Faker;

class PerfilesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i=1; $i < 11; $i++) {

            DB::update("update perfils set biografia = '" . $faker->text($maxNbChars = 1000) . "' where id = " . $i);
            DB::update("update perfils set imagen = 'upload-perfiles/default.jpeg' where id = " . $i);

        }

    }
}
