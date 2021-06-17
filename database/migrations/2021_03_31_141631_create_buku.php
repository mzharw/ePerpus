<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuku extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buku', function (Blueprint $table) {
            $table->id('idBuku');
            $table->string('nBuku');
            $table->foreignId('idPengarang');
            $table->foreignId('idPenerbit');
            $table->boolean('sBuku')->default(true);
            $table->timestamps();

            $table->foreign('idPengarang')->references('idPengarang')->on('pengarang')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('idPenerbit')->references('idPenerbit')->on('penerbit')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('buku');
    }
}
