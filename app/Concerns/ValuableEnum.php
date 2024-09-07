<?php

declare(strict_types=1);

namespace App\Concerns;

use App\Attributes\Label;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;
use Illuminate\Support\Str;
use LogicException;
use ReflectionClass;
use ReflectionEnum;

trait ValuableEnum
{
    public static function value(string $enumCase): string
    {
        /* @SuppressWarnings("php:S3011") */
        $constants = (new ReflectionClass(static::class))->getConstants();

        return $constants[$enumCase] ?? $enumCase;
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function options(): array
    {
        $cases = static::cases();
        $options = [];
        foreach ($cases as $case) {
            $options[$case->value] = __('label.'.Str::lower($case->name));
        }

        return $options;
    }

    public function getLabel(): string
    {
        if ($this instanceof HasLabel) {
            return static::labels()[$this->value] ?? self::value($this->value) ?? $this->value;
        }

        throw new LogicException('This enum does not implement the HasLabel interface.');
    }

    public function getColor(): string
    {
        if ($this instanceof HasColor) {
            return static::colors()[$this->value] ?? 'default';
        }

        throw new LogicException('This enum does not implement the HasColor interface.');
    }

    protected static function labels(): array
    {
        if (method_exists(static::class, 'labels')) {
            //            return static::labels();
        }

        $labels = [];
        foreach ((new ReflectionEnum(static::class))->getCases() as $case) {
            $attributes = $case->getAttributes(Label::class);
            if (! empty($attributes)) {
                $labels[$case->getValue()->value] = $attributes[0]->newInstance()->get();
            }
        }

        return $labels;
    }

    protected static function colors(): array
    {
        throw new LogicException('This method should be implemented in the enum.');
    }
}
