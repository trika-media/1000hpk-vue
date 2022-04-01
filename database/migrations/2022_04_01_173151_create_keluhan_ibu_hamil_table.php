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
        Schema::create('keluhan_ibu_hamil', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignUuid('ibu_hamil_id');
            $table->foreignUuid('penyakit_id');
            $table->string('nama_penyakit');

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
        Schema::dropIfExists('keluhan_ibu_hamil');
    }
};
