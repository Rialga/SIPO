<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class User extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->string('user_id',25)->primary();
            $table->unsignedBigInteger('user_role');
            $table->string('user_nick',15)->unique();
            $table->string('user_nama',30);
            $table->string('user_mail',40)->unique();
            $table->string('user_alamat',100);
            $table->string('user_job',35);
            $table->string('user_phone',15)->unique();
            $table->string('user_password',255);
            $table->timestamps();
            $table->string('google_id',255)->nullable();


            $table->foreign('user_role')->references('role_id')->on('role')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user');
    }
}
