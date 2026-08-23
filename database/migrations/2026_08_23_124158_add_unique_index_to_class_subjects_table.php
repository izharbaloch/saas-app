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
        // Guarded: the create_class_subjects_table migration already adds
        // this index on a fresh install, so this only does work on
        // databases where class_subjects existed before that fix landed.
        if (! Schema::hasIndex('class_subjects', ['class_section_id', 'subject_id'], 'unique')) {
            Schema::table('class_subjects', function (Blueprint $table) {
                $table->unique(['class_section_id', 'subject_id']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('class_subjects', function (Blueprint $table) {
            $table->dropUnique(['class_section_id', 'subject_id']);
        });
    }
};
