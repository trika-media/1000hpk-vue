<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ibu_hamil', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('identitas')->unique();
            $table->string('nama');
            $table->string('nomor_ponsel')->nullable();
            $table->text('alamat')->nullable();
            $table->date('tanggal_lahir')->nullable();

            $table->foreignUuid('puskesmas_id')->nullable();
            $table->foreignUuid('kelurahan_id')->nullable();
            $table->foreignUuid('kecamatan_id')->nullable();
            $table->foreignUuid('kabupaten_id')->nullable();
            $table->foreignUuid('provinsi_id')->nullable();

            $table->string('lat')->nullable();
            $table->string('lng')->nullable();

            $table->foreignUuid('mahasiswa_id');
            $table->string('ditambahkan_oleh');

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
        Schema::dropIfExists('ibu_hamil');
    }
};
