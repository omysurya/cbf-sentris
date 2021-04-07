<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TbAbsensi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('absensi', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->date('tanggal_cuti')->nullable();            
            $table->integer('id_user')->nullable();
            $table->string('jenis')->nullable();
            $table->string('alasan')->nullable();
            $table->integer('durasi')->nullable();
            $table->date('tanggal_masuk')->nullable();
            $table->string('status',25)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('absensi');
    }
}
