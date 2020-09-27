<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVillagesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('areanesia_villages', function (Blueprint $table) {
            $table->char('id', 10);
            $table->char('district_id', 7);
            $table->string('name', 50);

            $table->primary('id');
            $table->foreign('district_id')->references('id')->on('areanesia_districts');
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
        Schema::drop('areanesia_villages');
    }
}
