<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TbTrxVisitOutlet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('trx_visit_outlet', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();            
            $table->integer('id_visit_plan_outlet')->nullable();
            $table->dateTime('waktu_kunjungan')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('hasil_survei',500)->nullable();
            $table->string('tindak_lanjut',500)->nullable();
            $table->string('join_visit')->nullable();
            $table->string('catatan')->nullable();
            $table->string('penerima')->nullable();
            $table->string('jabatan_penerima')->nullable();
            $table->string('no_telp')->nullable();
            $table->string('ttd_image')->nullable();

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
        Schema::dropIfExists('trx_visit_outlet');
    }
}
