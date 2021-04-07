<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TbSalesPlanProduk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('sales_plan_produk', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();            
            $table->integer('id_produk')->nullable();            
            $table->integer('id_produk_group')->nullable();
            $table->integer('target')->nullable();            
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
        Schema::dropIfExists('sales_plan_produk');
    }
}
