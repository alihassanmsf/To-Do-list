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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->enum('priority', ['low', 'medium', 'high'])->default('low');
            $table->date('due_date');
            $table->enum('status', ['open', 'closed'])->default('open');

            // Foreign keys
            $table->unsignedBigInteger('created_by'); // Creator of the task
            $table->unsignedBigInteger('completed_by')->nullable(); // User who completed the task
            $table->unsignedBigInteger('assigned_for'); // User assigned to the task

            // Define foreign key constraints
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('completed_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('assigned_for')->references('id')->on('users')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
