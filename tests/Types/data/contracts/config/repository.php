<?php

use function PHPStan\Testing\assertType;

/** @var \Illuminate\Contracts\Config\Repository $repository */
/** @var string $dynamicPath */
/** @var string|'test' $partiallyDynamicPath */

assertType('\'test\'', $repository->get('app.name'));
assertType('15', $repository->get('app.iteration'));
assertType('\'settings\'', $repository->get('app.nested.other'));
assertType('mixed', $repository->get($dynamicPath));
assertType('mixed', $repository->get($partiallyDynamicPath));
