<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TbUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('user', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->integer('id_karyawan')->nullable();
            $table->string('username',50)->nullable();
            $table->string('password')->nullable();           
            $table->integer('id_provinsi')->nullable();                                        
            $table->integer('id_kota')->nullable();                                        
            $table->integer('id_role')->nullable();                                        
            $table->integer('id_subarea')->nullable();  
            $table->integer('id_area')->nullable();                  
            $table->integer('id_wilayah')->nullable();                  
            $table->integer('id_devisi')->nullable();
            $table->string('status',25)->default('disable');
            $table->boolean('is_online')->default(0);        
            $table->dateTime('last_online_datetime')->nullable();
            $table->string('last_latitude',255)->nullable();
            $table->string('last_longitude',255)->nullable();
            $table->dateTime('last_login')->nullable();
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
        Schema::dropIfExists('user');
    }
}
