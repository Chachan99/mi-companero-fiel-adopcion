<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // SQLite doesn't support MODIFY COLUMN or ENUM, so we'll skip this migration
        // The estado column should already support the required values as a string
        // If needed, we can add a check constraint or handle validation at the application level
        
        // For SQLite compatibility, we'll just ensure the foreign key exists
        if (config('database.default') !== 'sqlite') {
            // First, we need to drop the foreign key constraint if it exists
            Schema::table('animales', function (Blueprint $table) {
                $table->dropForeign(['fundacion_id']);
            });

            // Change the enum values to include 'perdido'
            DB::statement("ALTER TABLE animales MODIFY COLUMN estado ENUM('disponible', 'adoptado', 'en_adopcion', 'perdido') NOT NULL");

            // Re-add the foreign key constraint
            Schema::table('animales', function (Blueprint $table) {
                $table->foreign('fundacion_id')
                      ->references('usuario_id')
                      ->on('perfil_fundaciones')
                      ->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the foreign key constraint
        Schema::table('animales', function (Blueprint $table) {
            $table->dropForeign(['fundacion_id']);
        });

        // Revert back to the original enum values
        DB::statement("ALTER TABLE animales MODIFY COLUMN estado ENUM('disponible', 'adoptado', 'en_adopcion') NOT NULL");

        // Re-add the foreign key constraint
        Schema::table('animales', function (Blueprint $table) {
            $table->foreign('fundacion_id')
                  ->references('usuario_id')
                  ->on('perfil_fundaciones')
                  ->onDelete('cascade');
        });
    }
};