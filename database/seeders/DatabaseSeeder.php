<?php

namespace Database\Seeders;

use App\Models\Layanan;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@laundry.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Kasir Laundry',
            'email' => 'kasir@laundry.com',
            'password' => Hash::make('password'),
            'role' => 'kasir',
        ]);

        Layanan::create([
            'nama_layanan' => 'Reguler',
            'harga_per_kg' => 7000,
            'estimasi_waktu' => '3-4 hari',
        ]);

        Layanan::create([
            'nama_layanan' => 'Ekspres',
            'harga_per_kg' => 12000,
            'estimasi_waktu' => '1-2 hari',
        ]);

        Layanan::create([
            'nama_layanan' => 'Superkilat',
            'harga_per_kg' => 25000,
            'estimasi_waktu' => '5 jam selesai',
        ]);
    }
}