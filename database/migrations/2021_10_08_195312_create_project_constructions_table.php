<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectConstructionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_constructions', function (Blueprint $table) {
            $table -> id();
            $table -> foreignId('project_id') -> constrained() -> onDelete('cascade');
            $table -> string('category');
            $table -> string('name');
            $table -> string('amount');
            $table -> string('type');
            $table -> string('price');
            $table -> foreignId('company_id') -> constrained() -> onDelete('NO ACTION');
            $table -> string('total');
            $table -> string('paid');
            $table -> string('remain');
            $table -> string('date');
            $table -> string('bill');
            $table -> string('currency');
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
        Schema::dropIfExists('project_constructions');
    }
}
