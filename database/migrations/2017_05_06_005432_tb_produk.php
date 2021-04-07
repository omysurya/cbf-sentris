<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TbProduk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('produk', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();                        
            $table->integer('id_devisi')->nullable();            
            $table->integer('id_produk_group')->nullable();
            $table->string('kode')->nullable();
            $table->string('nama')->nullable();
            $table->string('deskripsi')->nullable();
            $table->string('kemasan')->nullable();
            $table->double('harga')->nullable();
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
        Schema::dropIfExists('produk');
    }
}
