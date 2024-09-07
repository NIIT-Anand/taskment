<?php

declare(strict_types=1);

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\UserPosition;
use App\Enums\UserSubPosition;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

final class User extends Authenticatable implements FilamentUser
{
    use HasFactory, HasUuids, Notifiable;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'position',
        'sub_position',
    ];

    /**
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function canAccessPanel(Panel $panel): bool
    {
        return str_ends_with($this->email, '@example.com');
    }

    /**
     * @return HasMany<Project>
     */
    public function projectsAsManager(): HasMany
    {
        return $this->hasMany(
            related: Project::class,
            foreignKey: 'manager_id'
        );
    }

    /**
     * @return HasMany<Requirement>
     */
    public function requirements(): HasMany
    {
        return $this->hasMany(
            related: Requirement::class,
            foreignKey: 'created_by'
        );
    }

    public function tasks(): BelongsToMany
    {
        return $this->belongsToMany(
            related: Task::class,
            table: 'task_user',
            foreignPivotKey: 'user_id',
            relatedPivotKey: 'task_id',
        )->withPivot('role');
    }

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'position' => UserPosition::class,
            'sub_position' => UserSubPosition::class,
        ];
    }
}
