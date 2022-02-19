<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKwintansiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kwitansi', function (Blueprint $table) {
            $table->string('id',10);

            $table->integer('uang_harian')->nullable();
            $table->string('mata_anggaran_1')->nullable();
            $table->string('mata_anggaran_2')->nullable();
            $table->string('nomor_bukti')->nullable();
            $table->string('status');
            $table->string('bukti_sppd');

            $table->timestamps();

            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kwintansi');
    }
}
