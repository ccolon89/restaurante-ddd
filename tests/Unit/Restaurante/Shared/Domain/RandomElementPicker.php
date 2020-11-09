<?php

declare(strict_types = 1);

namespace Tests\Unit\Restaurante\Shared\Domain;

final class RandomElementPicker
{
    public static function from(...$elements)
    {
        return MotherCreator::random()->randomElement($elements);
    }
}
