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
        Schema::create('task_user', function (Blueprint $table): void {
            $table->foreignUuid('task_id')->primary()->constrained('tasks')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignUuid('user_id')->primary()->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('role', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_user');
    }
};
