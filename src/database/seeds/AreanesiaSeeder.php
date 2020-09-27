<?php

use Illuminate\Database\Seeder;

class AreanesiaSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AreanesiaProvinceSeeder::class);
        $this->call(AreanesiaRegencySeeder::class);
        $this->call(AreanesiaDistrictSeeder::class);
        $this->call(AreanesiaVillageSeeder::class);
    }
}
