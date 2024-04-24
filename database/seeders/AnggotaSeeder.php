<?php

namespace Database\Seeders;

use App\Models\Anggota;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AnggotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('id_ID');
        for ($i = 0; $i < 10; $i++) {
            Anggota::create(
                [
                    'nama' => $faker->name,
                    'email' => $faker->email,
                    'no_hp' => '081'.$faker->randomNumber(9),
                    'alamat' => 'Jl. Jendral Soedirman No. 18'
                ]
            );
        }
    }
}
