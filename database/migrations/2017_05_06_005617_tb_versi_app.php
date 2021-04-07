<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TbVersiApp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('versi_app', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();            
            $table->integer('id_devisi')->nullable();
            $table->integer('major')->default(0);
            $table->integer('minor')->default(0);
            $table->integer('revision')->default(0);
            $table->integer('build')->default(0);
            $table->text('deskripsi')->nullable();
            $table->string('url')->nullable();
            $table->string('nama_file')->nullable();
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
        Schema::dropIfExists('versi_app');
    }
}
