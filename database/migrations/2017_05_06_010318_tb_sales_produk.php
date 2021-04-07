<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TbSalesProduk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('sales_produk', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->integer('id_sales_plan')->nullable();
            $table->integer('id_produk')->nullable();
            $table->integer('id_produk_group')->nullable();
            $table->string('invoice')->nullable();
            $table->integer('qty')->nullable();
            $table->integer('claim')->nullable();
            $table->integer('id_user')->nullable();

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
        Schema::dropIfExists('sales_produk');
    }
}
