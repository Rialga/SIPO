<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DetailSewa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_sewa', function (Blueprint $table) {

            $table->string('detail_sewa_nosewa',30);
            $table->string('detail_sewa_alat_kode',15);
            $table->integer('total_alat');
            $table->integer('harga_sewa1');
            $table->integer('harga_sewa2');
            $table->integer('harga_sewa3');
            $table->timestamps();


            $table->foreign('detail_sewa_nosewa')->references('sewa_no')->on('penyewaan')->onDelete('cascade');
            $table->foreign('detail_sewa_alat_kode')->references('alat_kode')->on('alat')->onDelete('cascade');
            $table->primary(['detail_sewa_no_sewa','detail_sewa_alat_kode']);


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_sewa');

    }
}
