<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TbVisitPlan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('visit_plan', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();            
            $table->integer('id_devisi')->nullable();
            $table->string('kode')->nullable();
            $table->string('nama_bulan')->nullable();
            $table->integer('bulan_ke')->nullable();
            $table->integer('tahun_bulan')->nullable();            
            $table->integer('id_region')->nullable();            
            $table->integer('id_area')->nullable();            
            $table->integer('id_subarea')->nullable();            
            $table->integer('id_user')->nullable();            
            $table->integer('id_am')->nullable();
            $table->string('supervisor')->nullable();
            $table->integer('jumlah_hke')->nullable();            
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
        Schema::dropIfExists('visit_plan');
    }
}
