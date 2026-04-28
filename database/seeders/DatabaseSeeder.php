<?php

namespace Database\Seeders;

use App\Models\category;
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
            'name' => 'Admin Inventaris',
            'email' => 'admin@mail.com',
            'password' => Hash::make('password'), // Selalu gunakan Hash untuk keamanan
        ]);

        User::create([
            'name' => 'Staff Gudang',
            'email' => 'staff@mail.com',
            'password' => Hash::make('password'),
        ]);

        // 2. Buat Dummy Kategori (Sesuai Flowchart: IT & Publikasi)
        category::create(['name' => 'Barang IT']);
        Category::create(['name' => 'Barang Publikasi']);

        $this->command->info('Dummy data berhasil dibuat!');
    }
}
