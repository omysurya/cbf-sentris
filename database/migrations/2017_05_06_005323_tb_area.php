<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TbArea extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('area', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();                        
            $table->integer('id_wilayah')->nullable();            
            $table->string('kode')->nullable();
            $table->string('nama')->nullable();            
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
        Schema::dropIfExists('area');
    }
}
