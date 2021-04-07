<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TbLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('log', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();            
            $table->integer('id_user')->nullable();
            $table->string('ipaddress')->nullable();
            $table->string('useragent')->nullable();
            $table->string('url')->nullable();
            $table->string('deskripsi')->nullable();            
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
        Schema::dropIfExists('log');
    }
}
