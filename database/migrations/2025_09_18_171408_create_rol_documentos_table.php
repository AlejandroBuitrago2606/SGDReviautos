<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rolDocumento', function (Blueprint $table) {

            // indico que no necesito un id autoincremental
            $table->unsignedBigInteger('idRol');
            $table->unsignedBigInteger('idDocumento');

            $table->foreign('idDocumento')->references('id')->on('documento')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('idRol')->references('id')->on('rol')->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['idRol', 'idDocumento']); // PK compuesta.

            $table->integer('acceso')->default(0);
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rolDocumento');
    }
};
