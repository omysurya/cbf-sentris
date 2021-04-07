<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TbTempatPraktik extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('tempat_praktik', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();            
            $table->integer('id_dokter')->nullable();
            $table->string('nama')->nullable();
            $table->string('alamat')->nullable();            
            $table->integer('id_provinsi')->nullable();            
            $table->integer('id_kota')->nullable();
            $table->string('tipe')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable(); 
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tempat_praktik');
    }
}
