<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class JenisAlat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jenis_alat', function (Blueprint $table) {
            $table->bigIncrements('jenis_alat_id');
            $table->string('jenis_alat_nama', 15);
            $table->integer('jenis_alat_harga1');
            $table->integer('jenis_alat_harga2');
            $table->integer('jenis_alat_harga3');
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
        Schema::dropIfExists('jenis_alat');
    }
}
