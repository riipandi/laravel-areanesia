<?php

use Illuminate\Database\Seeder;
use Riipandi\Areanesia\RawDataGetter;

class AreanesiaDistrictSeeder extends Seeder
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
        $districts = RawDataGetter::getDistricts();

        // Insert Data to Database
        DB::table('areanesia_districts')->insert($districts);
    }
}
