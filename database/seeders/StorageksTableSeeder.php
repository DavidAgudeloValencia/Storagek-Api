<?php

namespace Database\Seeders;

use App\Models\Storagek;
use Illuminate\Database\Seeder;

class StorageksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //delete the existing records to start from scratch.
        Storagek::truncate();
        $faker = \Faker\Factory::create();
        //let's create a few attributes in our database
        for ($i = 0; $i < 50; $i++) {
            Storagek::create([
                'file' => $faker->image('public/storage/images',640,480, null, false),
                'email' => $faker->email,
            ]);
        }
    }
}
