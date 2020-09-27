<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistrictsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('areanesia_districts', function (Blueprint $table) {
            $table->char('id', 7);
            $table->char('regency_id', 4);
            $table->string('name', 50);

            $table->primary('id');
            $table->foreign('regency_id')->references('id')->on('areanesia_regencies');
            $table->index('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('areanesia_districts');
    }
}
