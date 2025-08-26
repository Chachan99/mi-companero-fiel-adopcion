<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameOldMigrations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Renombrar las migraciones antiguas para que se ejecuten en el orden correcto
        if (Schema::hasTable('migrations')) {
            // Obtener las migraciones que necesitan ser renombradas
            $migrations = DB::table('migrations')
                ->where('migration', 'like', '0001%')
                ->get();
            
            // Actualizar cada migración individualmente para compatibilidad con SQLite
            foreach ($migrations as $migration) {
                $newName = '2023_' . substr($migration->migration, 5);
                DB::table('migrations')
                    ->where('id', $migration->id)
                    ->update([
                        'migration' => $newName,
                        'batch' => 1
                    ]);
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Revertir los cambios si es necesario
        if (Schema::hasTable('migrations')) {
            DB::table('migrations')
                ->where('migration', 'like', '2023_%')
                ->update([
                    'migration' => DB::raw("CONCAT('0001', SUBSTRING(migration, 5))"),
                    'batch' => 1
                ]);
        }
    }
}
