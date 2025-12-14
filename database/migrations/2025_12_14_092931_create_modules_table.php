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
    Schema::create('modules', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->text('description')->nullable();
        
        // Admin toggles availability (archived or active)
        $table->boolean('is_available')->default(true);

        // Assigned teacher (admin chooses)
        $table->unsignedBigInteger('teacher_id')->nullable();
        $table->foreign('teacher_id')
              ->references('id')
              ->on('users')
              ->onDelete('set null');

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
{
    Schema::dropIfExists('modules');
}
};