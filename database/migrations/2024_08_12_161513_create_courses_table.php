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
        Schema::create('courses', function (Blueprint $table) {
            $table->string('id', 36)->unique()->primary();
            $table->string('title');
            $table->text('description');
            $table->string('cover_path');
            $table->boolean(column: 'status');
            $table->string('instructor_id', 36);
            $table->foreign('instructor_id')
                ->references('id')
                ->on(table: 'instructors')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
