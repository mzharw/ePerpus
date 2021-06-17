<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePinjam extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pinjam', function (Blueprint $table) {
            $table->id('idPinjam');
            $table->foreignId('idAnggota');
            $table->foreign('idAnggota')->references('idAnggota')->on('anggota')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('idBuku');
            $table->foreign('idBuku')->references('idBuku')->on('buku')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('id');
            $table->foreign('id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->boolean('sPinjam')->default(true);
            $table->dateTime('tPinjam');
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
        Schema::dropIfExists('pinjam');
    }
}
