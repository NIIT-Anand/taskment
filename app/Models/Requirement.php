<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\RequirementStatus;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class Requirement extends Model
{
    use HasFactory, HasUuids;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'project_id',
        'parent_id',
        'name',
        'description',
        'status',
        'created_by',
    ];

    /**
     * @return BelongsTo<Project, Requirement>
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(
            related: Project::class,
            foreignKey: 'project_id',
        );
    }

    /**
     * @return BelongsTo<User, Requirement>
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(
            related: User::class,
            foreignKey: 'created_by',
        );
    }

    /**
     * @return BelongsTo<Requirement, Requirement>
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(
            related: self::class,
            foreignKey: 'parent_id',
        );
    }

    /**
     * @return HasMany<Requirement>
     */
    public function children(): HasMany
    {
        return $this->hasMany(
            related: self::class,
            foreignKey: 'parent_id',
        );
    }

    public function tasks(): BelongsToMany
    {
        return $this->belongsToMany(
            related: Task::class,
            table: 'requirement_task',
            foreignPivotKey: 'requirement_id',
            relatedPivotKey: 'task_id',
        );
    }

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'status' => RequirementStatus::class,
        ];
    }
}
