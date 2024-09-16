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
        Schema::create('contents', function (Blueprint $table) {
            $table->string('id', 36)->unique()->primary();
            $table->string('title');
            $table->text('description');
            $table->string('cover_path');
            $table->string('video_path');
            $table->boolean('status');
            $table->string('course_id', 36);
            $table->foreign('course_id')
                ->references('id')
                ->on(table: 'courses')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->string('instructor_id', 36);
            $table->foreign('instructor_id')
                ->references('id')
                ->on(table: 'instructors')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId('content_type_id')
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->date('dead_line')
                ->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contents');
    }
};
