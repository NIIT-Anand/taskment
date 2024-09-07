<?php

declare(strict_types=1);

namespace App\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS_CONSTANT)]
final readonly class BackgroundColor extends AttributeProperty
{
    public function __construct(
        private mixed $value,
    ) {}

    public function get(): string
    {
        return 'bg-'.$this->value.'-100';
    }
}
