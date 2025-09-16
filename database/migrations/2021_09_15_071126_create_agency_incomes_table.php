<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgencyIncomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agency_incomes', function (Blueprint $table) {
            $table -> id() -> autoIncrement();
            $table -> foreignId('agency_id') -> constrained() -> onDelete('cascade');
            $table -> string('amount');
            $table -> string('duration');
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
        Schema::dropIfExists('agency_incomes');
    }
}
