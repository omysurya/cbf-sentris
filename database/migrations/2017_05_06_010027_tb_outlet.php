<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TbOutlet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('outlet', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->boolean('is_mcl');
            $table->string('kode')->nullable();
            $table->string('nama')->nullable();
            $table->string('tipe')->nullable();
            $table->string('outlet_pic')->nullable();
            $table->string('outlet_pic_jabatan')->nullable();
            $table->string('status')->nullable();
            $table->string('kelas')->nullable();
            $table->string('nomor_kontak')->nullable();
            $table->string('alamat')->nullable();            
            $table->integer('id_provinsi')->nullable();            
            $table->integer('id_kota')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('catatan')->nullable();
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
        Schema::dropIfExists('outlet');
    }
}
