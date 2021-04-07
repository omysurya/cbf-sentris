<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TbDokter extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::disableForeignKeyConstraints();
        Schema::create('dokter', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->boolean('is_mcl');
            $table->string('kode')->nullable();
            $table->string('status')->nullable();
            $table->string('gelar')->nullable();
            $table->string('nama')->nullable();
            $table->integer('id_spesialis_dokter')->nullable();
            $table->string('id_kelas')->nullable();
            $table->string('nomor_kontak')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->string('tanggal_lahir')->nullable();
            $table->string('alamat_rumah')->nullable();
            $table->string('telp_rumah')->nullable();
            $table->integer('id_instansi_praktik')->nullable();
            $table->string('tipe')->nullable();            
            $table->integer('id_provinsi')->nullable();            
            $table->integer('id_kota')->nullable();
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
        Schema::dropIfExists('dokter');
    }
}
