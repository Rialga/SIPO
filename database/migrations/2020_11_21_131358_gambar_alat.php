<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class GambarAlat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gambar_alat', function (Blueprint $table) {
            $table->bigIncrements('gambar_id');
            $table->string('gambar_kodealat',15);
            $table->string('gambar_file',50);
            $table->timestamps();

            $table->foreign('gambar_kodealat')->references('alat_kode')->on('alat')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gambar_alat');
    }
}
