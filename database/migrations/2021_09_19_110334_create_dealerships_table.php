<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDealershipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dealerships', function (Blueprint $table) {
            $table -> id();
            $table -> foreignId('properties_id')->constrained()->onDelete('cascade');
            $table -> string('name');
            $table -> string('floor');
            $table -> string('apartment');
            $table -> string('customer');
            $table -> string('phone_number');
            $table -> string('floorNum');
            $table -> string('apartmentNum');
            $table -> string('deal');
            $table -> string('amount');
            $table -> string('photo');
            $table -> string('date');
            $table -> string('description');
            $table -> timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dealerships');
    }
}
