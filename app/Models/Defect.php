<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\DefectSeverity;
use App\Enums\DefectStatus;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class Defect extends Model
{
    use HasFactory, HasUuids;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'project_id',
        'task_id',
        'description',
        'severity',
        'status',
        'reported_by',
    ];

    /**
     * @return BelongsTo<Project, Defect>
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(
            related: Project::class,
            foreignKey: 'project_id',
        );
    }

    /**
     * @return BelongsTo<Task, Defect>
     */
    public function task(): BelongsTo
    {
        return $this->belongsTo(
            related: Task::class,
            foreignKey: 'task_id',
        );
    }

    /**
     * @return BelongsTo<User, Defect>
     */
    public function reportedBy(): BelongsTo
    {
        return $this->belongsTo(
            related: User::class,
            foreignKey: 'reported_by',
        );
    }

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'severity' => DefectSeverity::class,
            'status' => DefectStatus::class,
        ];
    }
}
