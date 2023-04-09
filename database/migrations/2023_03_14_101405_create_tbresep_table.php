<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbresepTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbresep', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('namaresep');
            $table->integer('resep_id');
            $table->string('deskripsi');
            $table->enum('rating',array('1','2','3','4','5'))->default('1');
            $table->integer('waktuproses');
            $table->integer('views');
            $table->string('caramembuat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbresep');
    }
}
