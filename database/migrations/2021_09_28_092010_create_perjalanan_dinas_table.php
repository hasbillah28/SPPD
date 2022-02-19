<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerjalananDinasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perjalanan_dinas', function (Blueprint $table) {
            $table->string('id', 18);
            $table->string('no_surat_tugas')->nullable();
            $table->text('deskripsi');
            $table->string('tempat');
            $table->date('tanggal_berangkat');
            $table->date('tanggal_kembali');
            $table->text('komentar')->nullable();
            $table->string('status', 4);
            $table->string('tempat_berangkat');
            $table->string('tempat_tujuan');
            $table->timestamps();
            $table->string('user_id',10);
            $table->string('jenis_angkutan_id');

            $table->primary('id');

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('jenis_angkutan_id')->references('id')->on('jenis_angkutan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('perjalanan_dinas');
    }
}
