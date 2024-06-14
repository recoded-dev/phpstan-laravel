<?php

declare(strict_types=1);

namespace Recoded\PHPStanLaravel\Extensions\Container;

use Illuminate\Container\Container;

final class ContainerDynamicReturnType extends MakeGetDynamicReturnType
{
    public function getClass(): string
    {
        return Container::class;
    }
}
