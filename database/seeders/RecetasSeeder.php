<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Receta;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RecetasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i=0; $i < 1000; $i++) {
            $receta = Receta::create([
                'titulo' => 'Receta de ' . $faker->firstname,
                'ingredientes' => $faker->text($maxNbChars = 2000),
                'preparacion' => $faker->text($maxNbChars = 2000),
                'imagen' => 'upload-recetas/' . random_int(1, 14) . '.jpg',
                'user_id' => random_int(1, 10),
                'categoria_id' => random_int(1, 7),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }

    }
}
