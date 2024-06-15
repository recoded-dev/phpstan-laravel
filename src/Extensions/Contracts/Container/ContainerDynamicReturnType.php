<?php

declare(strict_types=1);

namespace Recoded\PHPStanLaravel\Extensions\Contracts\Container;

use Illuminate\Contracts\Container\Container;
use Recoded\PHPStanLaravel\Extensions\Container\MakeGetDynamicReturnType;

final class ContainerDynamicReturnType extends MakeGetDynamicReturnType
{
    public function getClass(): string
    {
        return Container::class;
    }
}
