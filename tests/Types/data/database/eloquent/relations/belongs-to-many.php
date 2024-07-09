<?php

use function PHPStan\Testing\assertType;

/** @var \Illuminate\Database\Eloquent\Relations\BelongsToMany<\Tests\Types\Fakes\Category, \Tests\Types\Fakes\Post> $relation */
/** @var \Tests\Types\Fakes\Category $category */

assertType('Tests\Types\Fakes\Category', $relation->findOrNew(1));
assertType('Illuminate\Database\Eloquent\Collection<int, Tests\Types\Fakes\Category>', $relation->findOrNew([1]));
assertType('Tests\Types\Fakes\Category', $relation->firstOrNew());
assertType('Tests\Types\Fakes\Category', $relation->firstOrCreate());
assertType('Tests\Types\Fakes\Category', $relation->createOrFirst());
assertType('Tests\Types\Fakes\Category', $relation->updateOrCreate(['foo' => 'bar']));
assertType('Tests\Types\Fakes\Category|null', $relation->find(1));
assertType('Illuminate\Database\Eloquent\Collection<int, Tests\Types\Fakes\Category>', $relation->find([1]));
assertType('Illuminate\Database\Eloquent\Collection<int, Tests\Types\Fakes\Category>', $relation->findMany([1]));
assertType('Tests\Types\Fakes\Category', $relation->findOrFail(1));
assertType('Illuminate\Database\Eloquent\Collection<int, Tests\Types\Fakes\Category>', $relation->findOrFail([1]));
assertType('string|Tests\Types\Fakes\Category', $relation->findOr(1, fn () => 'foo-bar'));
assertType('string|Tests\Types\Fakes\Category', $relation->findOr(1, fn () => 'foo-bar'));
assertType('Illuminate\Database\Eloquent\Collection<int, Tests\Types\Fakes\Category>|string', $relation->findOr([1], ['*'], fn () => 'foo-bar'));
assertType('Illuminate\Database\Eloquent\Collection<int, Tests\Types\Fakes\Category>|string', $relation->findOr([1], fn () => 'foo-bar'));
assertType('Tests\Types\Fakes\Category|null', $relation->firstWhere('foo', 'bar'));
assertType('Tests\Types\Fakes\Category|null', $relation->first());
assertType('Tests\Types\Fakes\Category', $relation->firstOrFail());
assertType('string|Tests\Types\Fakes\Category', $relation->firstOr(fn () => 'foo-bar'));
assertType('Illuminate\Database\Eloquent\Collection<int, Tests\Types\Fakes\Category>', $relation->get());
assertType('Tests\Types\Fakes\Category', $relation->save($category));
assertType('Tests\Types\Fakes\Category', $relation->saveQuietly($category));
assertType('array{Tests\Types\Fakes\Category}', $relation->saveMany([$category]));
assertType('array{Tests\Types\Fakes\Category}', $relation->saveManyQuietly([$category]));
assertType('Tests\Types\Fakes\Category', $relation->create(['foo' => 'bar']));
assertType('array<int, Tests\Types\Fakes\Category>', $relation->createMany([['foo' => 'bar']]));
