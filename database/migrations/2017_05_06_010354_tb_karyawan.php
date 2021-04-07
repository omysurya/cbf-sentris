<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TbKaryawan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('karyawan', function (Blueprint $table) {
            $table->increments('id'); 
            $table->timestamps();
            $table->softDeletes();
            $table->string('kode')->nullable();
            $table->string('nama_lengkap')->nullable();
            $table->string('no_telp')->nullable();
            $table->string('email')->nullable();
            $table->string('alamat')->nullable();                                                            
            $table->integer('id_provinsi')->nullable();                                                            
            $table->integer('id_kota')->nullable();                                                            
            $table->string('keterangan')->nullable();                        
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
        Schema::dropIfExists('karyawan');
    }
}
