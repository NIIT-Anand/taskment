<?php

declare(strict_types=1);

namespace App\Concerns;

use App\Attributes\AttributeProperty;
use BadMethodCallException;
use Illuminate\Support\Str;
use ReflectionAttribute;
use ReflectionEnum;

trait AttributableEnum
{
    public function __call(string $method, array $arguments): mixed
    {
        $attributes = (new ReflectionEnum(static::class))->getCase($this->name)->getAttributes();

        $filtered_attributes = array_filter($attributes, fn (ReflectionAttribute $attribute): bool => $attribute->getName() === AttributeProperty::ATTRIBUTE_PATH.Str::ucfirst($method));

        if ($filtered_attributes === []) {
            throw new BadMethodCallException(sprintf('Call to undefined method %s::%s()', static::class, $method));
        }

        return array_shift($filtered_attributes)->newInstance()->get();
    }
}
