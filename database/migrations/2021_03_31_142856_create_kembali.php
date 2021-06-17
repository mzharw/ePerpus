<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKembali extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kembali', function (Blueprint $table) {
            $table->foreignId('idPinjam');
            $table->foreign('idPinjam')->references('idPinjam')->on('pinjam')->onDelete('cascade')->onUpdate('cascade');
            $table->dateTime('tKembali');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kembali');
    }
}
