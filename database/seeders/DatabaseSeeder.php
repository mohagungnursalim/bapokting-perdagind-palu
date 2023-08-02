<?php

namespace Database\Seeders;
use App\Models\Komoditas;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        $faker = Faker::create();

        for ($i = 0; $i < 1000000; $i++) {
        Komoditas::create([
                    'nama' => $faker->name
                    // Tambahkan kolom lainnya sesuai kebutuhan Anda
                ]);
        }
    }
}
