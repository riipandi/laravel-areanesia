<?php

use Illuminate\Database\Seeder;
use Riipandi\Areanesia\RawDataGetter;

class AreanesiaRegencySeeder extends Seeder
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
        $regencies = RawDataGetter::getRegencies();

        // Insert Data to Database
        DB::table('areanesia_regencies')->insert($regencies);
    }
}
