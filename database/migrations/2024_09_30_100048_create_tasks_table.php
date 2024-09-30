<?php

use App\Enums\TaskStatus;
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
            $table->uuid('id')->primary();
            $table->foreignUuid('project_id')->nullable()->references('id')->on('projects')->cascadeOnDelete();
            $table->string('name');
            $table->integer('priority');
            $table->date('completion_date');
            $table->time('completion_time');
            $table->enum('status', array_map(fn ($case) => $case->value, TaskStatus::cases()))->default(TaskStatus::TODO->value);
            $table->timestamps();
            $table->softDeletes();
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
