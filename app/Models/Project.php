<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\ProjectStatus;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class Project extends Model
{
    use HasFactory, HasUuids;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'tenant_id',
        'manager_id',
        'status',
    ];

    /**
     * @return BelongsTo<User, Project>
     */
    public function manager(): BelongsTo
    {
        return $this->belongsTo(
            related: User::class,
            foreignKey: 'manager_id',
        );
    }

    /**
     * @return BelongsTo<Tenant, Project>
     */
    public function tenant(): BelongsTo
    {
        return $this->belongsTo(
            related: Tenant::class,
            foreignKey: 'tenant_id',
        );
    }

    /**
     * @return HasMany<Task>
     */
    public function tasks(): HasMany
    {
        return $this->hasMany(
            related: Task::class,
            foreignKey: 'project_id'
        );
    }

    /**
     * @return HasMany<Requirement>
     */
    public function requirements(): HasMany
    {
        return $this->hasMany(
            related: Requirement::class,
            foreignKey: 'project_id'
        );
    }

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'status' => ProjectStatus::class,
        ];
    }
}
