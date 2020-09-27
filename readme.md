# Laravel Areanesia
[![Build Status](https://travis-ci.org/riipandi/laravel-areanesia.svg?branch=master)](https://travis-ci.org/riipandi/laravel-areanesia)
[![StyleCI](https://styleci.io/repos/298961264/shield?branch=master)](https://styleci.io/repos/298961264)
[![License](https://poser.pugx.org/riipandi/laravel-areanesia/license)](https://packagist.org/packages/riipandi/laravel-areanesia)
[![Latest Stable Version](https://poser.pugx.org/riipandi/laravel-areanesia/v/stable)](https://packagist.org/packages/riipandi/laravel-areanesia)
[![Total Downloads](https://poser.pugx.org/riipandi/laravel-areanesia/downloads)](https://packagist.org/packages/riipandi/laravel-areanesia)

Larvel Areanesia adalah sebuah package Laravel untuk menyimpan data wilayah Indonesia mulai dari Provinsi, 
Kabupaten/Kota, Kecamatan/Distrik, sampai Desa/Kelurahan. Package akan menambahkan migrations, seeder 
(untuk import data ke database) dan Model pada project Anda.

Semua data akan disimpan di database, untuk mengambil data tersebut sama dengan mengambil data lewat Model 
pada umumnya (Lihat bagian Usage).

Data ini diambil dari situs Pemutakhiran MFD dan MBS Badan Pusat Statistik (http://mfdonline.bps.go.id/)
pada 11 Januari 2018. Sumber: [Wilayah Administratif Indonesia][wilayahindonesia].

## Quick Instalation
```sh
# Install package
composer require riipandi/laravel-areanesia

# Publish files
php artisan areanesia:publish

# Dump load composer
composer dump-autoload
```

### Register Service Provider

#### Laravel
Jika Anda menggunakan Laravel versi 5.5 keatas Anda bisa skip bagian ini karena paket ini sudah menggunakan Package Auto Discovery.

Tapi jika kebetulan Project yang Anda kerjakan masih menggunakan versi dibawah 5.5 maka silahkan untuk membuka
file `config/app.php` lalu tambahkan Class `AreanesiaServiceProvider` kedalam array Service Providers:

```php
// Provider Lain
Riipandi\Areanesia\AreanesiaServiceProvider::class,
```

#### Lumen
Jika Anda ingin menggunakan Package ini pada project Lumen, maka Anda harus melakukan register Service 
Provider pada file `bootstrap/app.php` dengan menambahkan ini:

```php
$app->register(Riipandi\Areanesia\AreanesiaServiceProvider::class);
```

### Migrate and Seeder
Jalankan perintah dibawah untuk menjalankan migration dan seeder:

```sh
php artisan migrate

# Import semua data dari Provinsi sampai Kelurahan sekaligus
php artisan db:seed --class=AreanesiaSeeder   # Import data Provinsi, Kota/Kabupaten, Kecamatan/Distrik dan Desa/Kelurahan

# Anda juga bisa melakukan Import data satu per satu, mulai dari Provinsi sampai Kelurahan
php artisan db:seed --class=AreanesiaProvinceSeeder      # Import data provinsi
php artisan db:seed --class=AreanesiaRegencySeeder       # Import data kota/kabupaten
php artisan db:seed --class=AreanesiaDistrictSeeder      # Import data kecamatan/distrik
php artisan db:seed --class=AreanesiaVillageSeeder       # Import data desa/kelurahan
```

## Basic Usage
Anda bisa gunakan class dibawah seperti model pada umumnya.

```php
<?php

use App\Models\Province;
use App\Models\Regency;
use App\Models\District;
use App\Models\Village;

// Get semua data
$provinces = Province::all();
$regencies = Regency::all();
$districts = District::all();
$villages = Village::all();

// Cari berdasarkan nama
$provinces = Province::where('name', 'JAWA BARAT')->first();
$regencies = Regency::where('name', 'LIKE', '%SUKABUMI%')->first();
$districts = District::where('name', 'LIKE', 'BANDUNG%')->get();
$villages = Village::where('name', 'SURADE')->first();
```

## Advance Usage

```php
<?php

// Get Kecamatan dari sebuah Provinsi.
$districts = $province->districts;

// Cek jika provinsi memiliki kabupaten terkait menggunakan logika OR bedasarkan nama kabupaten.
$province->hasDistrictName(["SELAKAU TIMUR", "PEMANGKAT", "SEMPARUK", "JAWAK"]);

// Cek jika provinsi memiliki kabupaten terkait menggunakan logika AND bedasarkan nama kabupaten.
$province->hasDistrictName(["SELAKAU TIMUR", "PEMANGKAT", "SEMPARUK", "JAWAI"], true);

// Cek jika provinsi memiliki kabupaten terkait menggunakan logika OR bedasarkan id kabupaten.
$province->hasDistrictId([6101, 6102, 6103, 6104]);

// Cek jika provinsi memiliki kabupaten terkait menggunakan logika AND bedasarkan id kabupaten.
$province->hasDistrictId([6101, 6102, 6103, 6104], true);

// Get Kabupaten/Kota dari sebuah Provinsi
$regencies = $province->regencies;

// Get Kecamatan dari sebuah Kabupaten/Kota
$districts = $regency->districts;

// Get Desa/Kelurahan dari sebuah Kabupaten/Kota
$villages = $regency->villages;

// Cek jika kabupaten memiliki desa/kelurahan terkait menggunakan logika AND bedasarkan nama desa/kelurahan.
$regency->hasVillageName(["PARIT SETIA", "PELIMPAAN", "SEMPARUK"], true);

// Cek jika kabupaten memiliki desa/kelurahan terkait menggunakan logika AND bedasarkan id desa/kelurahan.
$regency->hasVillageId([6101050014, 6101040025, 6101060023, 6101020014]);

// Get Desa/Kelurahan dari sebuah Kecamatan
$villages = $district->villages;

// Cek Desa ada di sebuah Provinsi
$village->isProvince(61);

// Cek Desa ada di sebuah Kabupaten
$village->isRegency(6102);

// Cek Desa ada di sebuah Kecamatan
$village->isDistrict(6101050);

// Cek Kecamatan ada di sebuah Provinsi
$district->isProvince(61);

// Cek Kecamatan ada di sebuah Kabupaten
$village->isRegency(6102);

// Get Kabupaten dari sebuah Desa
$village->regency;

// Get Provinsi dari sebuah Desa
$village->province;

// Get Provinsi dari sebuah Kecamatan
$district->province;
```

## LICENSE
```
Copyright (c) 2020 Aris Ripandi.

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

   http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.
```

Please see [license file](./license.txt) for more information.

[wilayahindonesia]:https://github.com/edwardsamuel/Wilayah-Administratif-Indonesia
[choosealicense]:https://choosealicense.com/licenses/apache-2.0/
[releasepage]:https://github.com/riipandi/altstack/releases
