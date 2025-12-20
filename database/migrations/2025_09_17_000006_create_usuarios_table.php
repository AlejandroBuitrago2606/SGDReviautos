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
            Schema::create('usuario', callback: function (Blueprint $table) {
                $table->id();
                $table->string("nombreUsuario", 80);
                $table->string("telefono", 10);
                $table->string("email", 50);
                $table->string("password", 150);
                $table->foreignId('idRol')->constrained('rol','id')->onUpdate("cascade")->onDelete("cascade");
                $table->timestamps();
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('usuario');
        }
    };
