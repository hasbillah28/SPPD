<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerjalananDinasUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perjalanan_dinas_user', function (Blueprint $table) {
            $table->id();
            $table->string('perjalanan_dinas_id', 18);
            $table->string('no_sppd')->nullable();
            $table->string('user_id');

            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete('cascade');
            $table->foreign('perjalanan_dinas_id')->references('id')->on('perjalanan_dinas')->cascadeOnDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('perjalanan_dinas_user');
    }
}
