<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TbTrxVisitDokter extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('trx_visit_dokter', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();            
            $table->integer('id_visit_plan_dokter')->nullable();
            $table->dateTime('waktu_kunjungan')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('praktik')->nullable();            
            $table->integer('id_produk')->nullable();
            $table->string('join_visit')->nullable();
            $table->string('respon_dokter')->nullable();
            $table->string('catatan')->nullable();
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
        Schema::dropIfExists('trx_visit_dokter');
    }
}
