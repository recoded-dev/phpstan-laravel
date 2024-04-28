<?php

use function PHPStan\Testing\assertType;

/** @var \Illuminate\Database\Eloquent\Builder<\Tests\Types\Fakes\User> $builder */

assertType('Tests\Types\Fakes\User|null', $builder->first());
assertType('Illuminate\Database\Eloquent\Collection<int, Tests\Types\Fakes\User>', $builder->get());
