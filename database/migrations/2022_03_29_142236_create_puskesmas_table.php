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
        Schema::create('puskesmas', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('nama');
            $table->text('alamat');

            $table->foreignUuid('kelurahan_id')->nullable();
            $table->foreignUuid('kecamatan_id')->nullable();
            $table->foreignUuid('kabupaten_id')->nullable();
            $table->foreignUuid('provinsi_id')->nullable();

            $table->string('lat')->nullable();
            $table->string('lng')->nullable();

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
        Schema::dropIfExists('puskesmas');
    }
};
