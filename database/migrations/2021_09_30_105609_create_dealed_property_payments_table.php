<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDealedPropertyPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dealed_property_payments', function (Blueprint $table) {
            $table -> id();
            $table -> foreignId('dealership_id')->constrained()->ondelete('cascade');
            $table -> string('name');
            $table -> string('total');
            $table -> string('date');
            $table -> string('paid');
            $table -> string('remain');
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
        Schema::dropIfExists('dealed_property_payments');
    }
}
