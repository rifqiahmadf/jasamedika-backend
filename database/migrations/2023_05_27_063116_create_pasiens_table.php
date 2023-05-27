<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePasiensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pasiens', function (Blueprint $table) {
            $table->id();
            $table->string('Nama_Pasien');
            $table->string('Alamat');
            $table->string('No_Telepon');
            $table->string('RT_RW');
            $table->unsignedBigInteger('kelurahan_id');
            $table->foreign('kelurahan_id')->references('id')->on('kelurahans');
            $table->date('Tanggal_Lahir');
            $table->string('Jenis_Kelamin');
            $table->string('ID_Pasien')->unique();
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
        Schema::dropIfExists('pasiens');
    }
}
