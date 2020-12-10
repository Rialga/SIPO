<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Alat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alat', function (Blueprint $table) {
            $table->string('alat_kode',15)->primary();
            $table->unsignedBigInteger('alat_jenis');
            $table->unsignedBigInteger('alat_merk');
            $table->string('alat_tipe',25);
            $table->integer('alat_total');
            $table->timestamps();

            $table->foreign('alat_jenis')->references('jenis_alat_id')->on('jenis_alat')->onDelete('cascade');
            $table->foreign('alat_merk')->references('merk_id')->on('merk')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alat');

    }
}
