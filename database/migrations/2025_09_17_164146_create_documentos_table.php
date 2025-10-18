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
        Schema::create('documento', function (Blueprint $table) {
            $table->id("idDocumento");
            $table->string("consecutivo", 10);
            $table->string("nombre", 60);
            $table->date("fechaCreacion");
            $table->date("fechaVersion");
            $table->integer("n_version");
            $table->date("fechaRevision");
            $table->integer("n_revision");
            $table->integer("n_version_actualizada")->nullable();
            $table->string("numeral", 20)->nullable();
            $table->string("observaciones", 1500)->nullable();
            $table->string("rutaArchivo", 200);
            $table->foreignId("idProceso")->constrained('proceso', 'idProceso')->onUpdate("cascade")->onDelete("cascade");
            $table->foreignId("idTipoDocumento")->constrained('tipoDocumento', 'idTipoDocumento')->onUpdate("cascade")->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documento');
    }
};
