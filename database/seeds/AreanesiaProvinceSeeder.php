<?php

use Illuminate\Database\Seeder;
use Riipandi\Areanesia\RawDataGetter;

class AreanesiaProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @deprecated
     *
     * @return void
     */
    public function run()
    {
        // Get Data
        $provinces = RawDataGetter::getProvinces();

        // Insert Data to Database
        DB::table('areanesia_provinces')->insert($provinces);
    }
}
