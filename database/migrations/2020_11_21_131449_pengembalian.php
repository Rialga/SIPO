<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class Pengembalian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengembalian', function (Blueprint $table) {

            $table->string('sewa_no',30);
            $table->string('alat_kode',15);
            $table->unsignedBigInteger('kondisi_id');
            $table->integer('total_kerusakan');
            $table->integer('biaya_denda');
            $table->timestamp('pengembalian_waktu')->default(DB::raw('CURRENT_TIMESTAMP'));;
            $table->timestamps();


            $table->foreign('sewa_no')->references('sewa_no')->on('penyewaan')->onDelete('cascade');
            $table->foreign('alat_kode')->references('alat_kode')->on('alat')->onDelete('cascade');
            $table->foreign('kondisi_id')->references('kondisi_id')->on('kondisi_alat')->onDelete('cascade');

            $table->primary(['sewa_no','alat_kode','kondisi_id']);


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengembalian');

    }
}
