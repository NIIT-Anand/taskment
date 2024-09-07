<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\TaskStatus;
use App\Enums\TaskType;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class Task extends Model
{
    use HasFactory, HasUuids;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'project_id',
        'description',
        'status',
        'type',
        'group_name',
        'assigned_ba_id',
    ];

    /**
     * @return BelongsTo<Project, Task>
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(
            related: Project::class,
            foreignKey: 'project_id',
        );
    }

    /**
     * @return BelongsTo<User, Task>
     */
    public function assignedBa(): BelongsTo
    {
        return $this->belongsTo(
            related: User::class,
            foreignKey: 'assigned_ba_id',
        );
    }

    public function assignedTo(): BelongsToMany
    {
        return $this->belongsToMany(
            related: User::class,
            table: 'task_user',
            foreignPivotKey: 'task_id',
            relatedPivotKey: 'user_id',
        )->withPivot('role');
    }

    public function requirements(): BelongsToMany
    {
        return $this->belongsToMany(
            related: Requirement::class,
            table: 'requirement_task',
            foreignPivotKey: 'task_id',
            relatedPivotKey: 'requirement_id',
        );
    }

    /**
     * @return HasMany<Defect>
     */
    public function defects(): HasMany
    {
        return $this->hasMany(
            related: Defect::class,
            foreignKey: 'task_id',
        );
    }

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'status' => TaskStatus::class,
            'type' => TaskType::class,
        ];
    }
}
