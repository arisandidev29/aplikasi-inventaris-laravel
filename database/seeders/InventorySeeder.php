<?php

namespace Database\Seeders;

use App\Models\category;
use App\Models\items;
use App\Models\Loan;
use App\Models\transactions;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class InventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::transaction(function () {

            // USERS
            
            $admin = User::create([
                'name'     => 'Admin Inventaris',
                'email'    => 'admin29@inventaris.com',
                'password' => Hash::make('password'),
            ]);
            
            // CATEGORIES
            $catIT  = category::create(['name' => 'Barang IT']);
            $catPub = category::create(['name' => 'Barang Publikasi']);
            
            // ITEMS
            $laptop = items::create([
                'category_id' => $catIT->id,
                'kode_barang' => 'IT-001',
                'nama_barang' => 'Laptop Dell Latitude',
                'merk'        => 'Dell',
                'stok'        => 5,
                'kondisi'     => 'Bagus',
                'lokasi'      => 'Ruang Server',
                'deskripsi'   => 'Laptop operasional kantor',
            ]);

            $kamera = items::create([
                'category_id' => $catPub->id,
                'kode_barang' => 'PUB-001',
                'nama_barang' => 'Kamera Sony A6400',
                'merk'        => 'Sony',
                'stok'        => 2,
                'kondisi'     => 'Bagus',
                'lokasi'      => 'Ruang Publikasi',
                'deskripsi'   => 'Kamera mirrorless untuk dokumentasi',
            ]);
            
            // TRANSACTIONS
            transactions::create([
                'item_id'            => $laptop->id,
                'user_id'            => $admin->id,
                'type'               => 'masuk',
                'quantity'           => 5,
                'tanggal_transaksi'  => now()->subDays(10),
                'keterangan'         => 'Pengadaan awal laptop',
            ]);
            
            transactions::create([
                'item_id'            => $kamera->id,
                'user_id'            => $admin->id,
                'type'               => 'masuk',
                'quantity'           => 2,
                'tanggal_transaksi'  => now()->subDays(5),
                'keterangan'         => 'Pengadaan kamera publikasi',
            ]);
            
            // LOANS
            Loan::create([
            'item_id'                    => $laptop->id,
            'nama_peminjam'              => 'Budi Santoso',
            'jumlah'                     => 1,
            'tanggal_pinjam'             => now()->subDays(3),
            'tanggal_kembali_rencana'    => now()->addDays(4),
            'tanggal_kembali_realisasi'  => null,
            'status'                     => 'dipinjam',
        ]);
        
        Loan::create([
            'item_id'                    => $kamera->id,
            'nama_peminjam'              => 'Sari Dewi',
            'jumlah'                     => 1,
            'tanggal_pinjam'             => now()->subDays(7),
            'tanggal_kembali_rencana'    => now()->subDays(2),
            'tanggal_kembali_realisasi'  => now()->subDays(2),
            'status'                     => 'kembali',
        ]);
    });
    }
}
