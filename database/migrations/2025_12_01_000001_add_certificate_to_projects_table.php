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
        Schema::table('projects', function (Blueprint $table) {
            // Drop the old enum constraint and recreate with certificate option
            // SQLite doesn't support modifying columns directly, so we need to use a workaround
            DB::statement("
                CREATE TABLE projects_new (
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    user_id INTEGER NOT NULL,
                    title TEXT NOT NULL,
                    description TEXT,
                    category TEXT NOT NULL CHECK(category IN ('design', 'pdf', 'cybersecurity', 'tutorial', 'certificate')),
                    file_path TEXT NOT NULL,
                    original_filename TEXT NOT NULL,
                    file_size INTEGER NOT NULL,
                    created_at TIMESTAMP,
                    updated_at TIMESTAMP,
                    FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE
                )
            ");
            
            DB::statement("
                INSERT INTO projects_new 
                SELECT * FROM projects
            ");
            
            DB::statement("DROP TABLE projects");
            
            DB::statement("ALTER TABLE projects_new RENAME TO projects");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            DB::statement("
                CREATE TABLE projects_new (
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    user_id INTEGER NOT NULL,
                    title TEXT NOT NULL,
                    description TEXT,
                    category TEXT NOT NULL CHECK(category IN ('design', 'pdf', 'cybersecurity', 'tutorial')),
                    file_path TEXT NOT NULL,
                    original_filename TEXT NOT NULL,
                    file_size INTEGER NOT NULL,
                    created_at TIMESTAMP,
                    updated_at TIMESTAMP,
                    FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE
                )
            ");
            
            DB::statement("
                INSERT INTO projects_new 
                SELECT * FROM projects WHERE category != 'certificate'
            ");
            
            DB::statement("DROP TABLE projects");
            
            DB::statement("ALTER TABLE projects_new RENAME TO projects");
        });
    }
};
