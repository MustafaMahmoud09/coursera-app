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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->text('comment');
            $table->string('content_id', 36);
            $table->foreign('content_id')
                ->references('id')
                ->on(table: 'contents')
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
        Schema::dropIfExists('comments');
    }
};
