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
            $table->foreignId("idRol")->constrained('rol','idRol')->onUpdate("cascade")->onDelete("cascade");
            $table->foreignId("idDocumento")->constrained('documento', 'idDocumento')->onUpdate("cascade")->onDelete("cascade");
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
