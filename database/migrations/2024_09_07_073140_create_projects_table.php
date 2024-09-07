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
        Schema::create('projects', function (Blueprint $table): void {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->foreignUuid('tenant_id')->constrained('tenants')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignUuid('manager_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->enum('status', App\Enums\ProjectStatus::values());
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
