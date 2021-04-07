<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TbPermission extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permission', function (Blueprint $table) {
            $table->increments('id');                      
            $table->integer('id_role')->nullable();
            $table->boolean('can_view')->default(0); 
            $table->boolean('can_read')->default(0);
            $table->boolean('can_create')->default(0);
            $table->boolean('can_update')->default(0);
            $table->boolean('can_delete')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permission');
    }
}
