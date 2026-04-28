<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware("auth")->group(function() {

    
    Route::livewire("/dashboard","pages::dashboard")->name("dashboard");

    #menu inventaris
    Route::livewire("/dashboard/barang-it","pages::barang-it")->name("barang-it");
    Route::livewire("/dashboard/barang-publikasi","pages::barang-publikasi")->name("barang-publikasi");
    Route::livewire("/dashboard/category","pages::kategori-barang")->name("kategori");
    
    
    #menu pergerakan stok
    Route::livewire("/dashboard/barang-masuk","pages::barang-masuk")->name("barang-masuk");
    Route::livewire("/dashboard/barang-keluar","pages::barang-keluar")->name("barang-keluar");
    Route::livewire("/dashboard/peminjaman","pages::peminjaman")->name("peminjaman");
    
    
    #rekapitulasi
    Route::livewire("/dashboard/rekapitulasi","pages::rekapitulasi")->name("rekapitulasi");
    
});