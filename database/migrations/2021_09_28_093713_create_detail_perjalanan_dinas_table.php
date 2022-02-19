<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPerjalananDinasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_perjalanan_dinas', function (Blueprint $table) {
            $table->id();
            $table->string('perjalanan_dinas_id', 18);
            $table->foreign('perjalanan_dinas_id')->references('id')->on('perjalanan_dinas');

            $table->string('tiba_di')->nullable();
            $table->date('tiba_di_tanggal')->nullable();
            $table->string('berangkat_ke')->nullable();
            $table->date('berangkat_tanggal')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_perjalanan_dinas');
    }
}
