<?php

use function PHPStan\Testing\assertType;

/** @var \Illuminate\Database\Eloquent\Relations\BelongsTo<\Tests\Types\Fakes\Post, \Tests\Types\Fakes\User> $relation */
/** @var \Tests\Types\Fakes\User $user */

assertType('Tests\Types\Fakes\Post', $relation->associate($user));
assertType('Tests\Types\Fakes\Post', $relation->dissociate());
assertType('Tests\Types\Fakes\Post', $relation->disassociate());
assertType('Tests\Types\Fakes\Post', $relation->getChild());
