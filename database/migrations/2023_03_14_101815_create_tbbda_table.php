<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbbdaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbbda', function (Blueprint $table) {
            $table->id();
            $table->string('bahan');
            $table->string('alat');
            $table->unsignedBigInteger('resep_id');
            $table->foreign('resep_id')->references('id')->on('tbresep');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbbda');
    }
}
