<?php

use function PHPStan\Testing\assertType;

/** @var \Illuminate\Database\Eloquent\Builder $builder */

assertType('Illuminate\Database\Eloquent\Model|null', $builder->first());
