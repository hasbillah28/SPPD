<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyToKwitansiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kwitansi', function (Blueprint $table) {
            $table->foreignId('perjalanan_dinas_user_id')->constrained('perjalanan_dinas_user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kwitansi', function (Blueprint $table) {
            //
        });
    }
}
