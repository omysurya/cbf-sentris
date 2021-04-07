<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TbVisitPlanOutlet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('visit_plan_outlet', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();            
            $table->integer('id_visit_plan')->nullable();            
            $table->integer('id_outlet')->nullable();
            $table->dateTime('waktu_kunjungan')->nullable();
            $table->string('array_tanggal',1000)->nullable();            
            $table->integer('id_spv')->nullable();            
            $table->integer('id_user')->nullable();            
            $table->integer('created_by')->nullable();            
            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('visit_plan_outlet');
    }
}
