<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table -> id();
            $table -> foreignId('agency_id') -> constrained() -> ondelete('cascade');
            $table -> string('name');
            $table -> string('address');
            $table -> string('type');
            $table -> string('area');
            $table -> string('unit');
            $table -> string('floor');
            $table -> string('apartment');
            $table -> string('unitPrice');
            $table -> string('total');
            $table -> string('paid');
            $table -> string('remain');
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
        Schema::dropIfExists('projects');
    }
}
