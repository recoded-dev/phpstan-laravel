<?php

use function PHPStan\Testing\assertType;

/** @var \Illuminate\Database\Eloquent\Relations\HasOneOrMany<\Tests\Types\Fakes\Post, \Tests\Types\Fakes\User> $relation */
/** @var \Tests\Types\Fakes\Post $post */

assertType('Tests\Types\Fakes\Post', $relation->make(['foo' => 'bar']));
assertType('Illuminate\Database\Eloquent\Collection<int, Tests\Types\Fakes\Post>', $relation->makeMany([['foo' => 'bar']]));
assertType('Tests\Types\Fakes\Post', $relation->findOrNew(1));
assertType('Illuminate\Database\Eloquent\Collection<int, Tests\Types\Fakes\Post>', $relation->findOrNew([1]));
assertType('Tests\Types\Fakes\Post', $relation->firstOrNew(['foo' => 'bar']));
assertType('Tests\Types\Fakes\Post', $relation->firstOrCreate(['foo' => 'bar']));
assertType('Tests\Types\Fakes\Post', $relation->createOrFirst(['foo' => 'bar']));
assertType('Tests\Types\Fakes\Post', $relation->updateOrCreate(['foo' => 'bar']));
assertType('Tests\Types\Fakes\Post|false', $relation->save($post));
assertType('Tests\Types\Fakes\Post|false', $relation->saveQuietly($post));
assertType('iterable<Tests\Types\Fakes\Post>', $relation->saveMany([$post]));
assertType('iterable<Tests\Types\Fakes\Post>', $relation->saveManyQuietly([$post]));
assertType('Tests\Types\Fakes\Post', $relation->create(['foo' => 'bar']));
assertType('Tests\Types\Fakes\Post', $relation->createQuietly(['foo' => 'bar']));
assertType('Tests\Types\Fakes\Post', $relation->forceCreate(['foo' => 'bar']));
assertType('Tests\Types\Fakes\Post', $relation->forceCreateQuietly(['foo' => 'bar']));
assertType('Illuminate\Database\Eloquent\Collection<int, Tests\Types\Fakes\Post>', $relation->createMany([['foo' => 'bar']]));
assertType('Illuminate\Database\Eloquent\Collection<int, Tests\Types\Fakes\Post>', $relation->createManyQuietly([['foo' => 'bar']]));
