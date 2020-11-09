<?php

declare(strict_types = 1);

namespace Tests\Unit\Restaurante\Shared\Domain;

use Tests\Unit\Restaurante\Shared\Infrastructure\Mockery\MatcherIsSimilar;

final class TestUtils
{
    public static function similarTo($value, $delta = 0.0): MatcherIsSimilar
    {
        return new MatcherIsSimilar($value, $delta);
    }
}
