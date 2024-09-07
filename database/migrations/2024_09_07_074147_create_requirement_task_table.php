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
        Schema::create('requirement_task', function (Blueprint $table): void {
            $table->foreignUuid('task_id')->primary()->constrained('tasks')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignUuid('requirement_id')->primary()->constrained('requirements')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requirement_task');
    }
};
