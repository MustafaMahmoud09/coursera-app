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
        Schema::create('course_saves', function (Blueprint $table) {
            $table->string('id', 36)->unique()->primary();
            $table->string('course_id', 36);
            $table->foreign('course_id')
                ->references('id')
                ->on(table: 'courses')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->string('student_id', 36);
            $table->foreign('student_id')
                ->references('id')
                ->on(table: 'students')
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
        Schema::dropIfExists('course_saves');
    }
};
