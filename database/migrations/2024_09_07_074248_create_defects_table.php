<?php

declare(strict_types=1);

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
        Schema::create('defects', function (Blueprint $table): void {
            $table->uuid('id')->primary();
            $table->foreignUuid('project_id')->constrained('projects')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignUuid('task_id')->nullable()->constrained('tasks')->cascadeOnDelete()->cascadeOnUpdate();
            $table->text('description');
            $table->enum('severity', App\Enums\DefectSeverity::values());
            $table->enum('status', App\Enums\DefectStatus::values());
            $table->foreignUuid('reported_by')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('defects');
    }
};
