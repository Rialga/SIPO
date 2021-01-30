<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class Penyewaan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penyewaan', function (Blueprint $table) {
            $table->string('sewa_no',30)->primary();
            $table->integer('sewa_status');
            $table->string('sewa_user',25);
            $table->string('sewa_rek',20)->nullable();
            $table->timestamp('sewa_tglsewa')->default(DB::raw('CURRENT_TIMESTAMP'));;
            $table->timestamp('sewa_tglbayar')->default(DB::raw('CURRENT_TIMESTAMP'));;
            $table->timestamp('sewa_tglkembali')->default(DB::raw('CURRENT_TIMESTAMP'));;
            $table->string('sewa_tujuan',50);
            $table->string('sewa_buktitf',30);
            $table->timestamps();

            $table->foreign('sewa_status')->references('status_id')->on('status_sewa')->onDelete('cascade');
            $table->foreign('sewa_user')->references('user_id')->on('user')->onDelete('cascade');
            $table->foreign('sewa_rek')->references('rekening_no')->on('rekekning');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penyewaan');

    }
}
