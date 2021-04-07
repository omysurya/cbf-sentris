<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class KelasToIdKelasOutlet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('outlet', function (Blueprint $table) {
            //
            $table->renameColumn('kelas','id_kelas');
            // $table->integer('id_kelas')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    { 
        Schema::table('outlet', function (Blueprint $table) {
            //
        });
    }
}
