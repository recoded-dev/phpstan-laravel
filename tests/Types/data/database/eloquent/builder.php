<?php

use function PHPStan\Testing\assertType;

/** @var \Illuminate\Database\Eloquent\Builder<\Tests\Types\Fakes\User> $builder */

assertType('Tests\Types\Fakes\User', $builder->make(['foo' => 'bar']));
assertType('Tests\Types\Fakes\User|null', $builder->firstWhere('foo', 'bar'));
assertType('Illuminate\Database\Eloquent\Collection<int, Tests\Types\Fakes\User>', $builder->hydrate([]));
assertType('Illuminate\Database\Eloquent\Collection<int, Tests\Types\Fakes\User>', $builder->fromQuery('SELECT * FROM users'));
assertType('Tests\Types\Fakes\User|null', $builder->find(1));
assertType('Illuminate\Database\Eloquent\Collection<int, Tests\Types\Fakes\User>', $builder->find([1]));
assertType('Illuminate\Database\Eloquent\Collection<int, Tests\Types\Fakes\User>', $builder->findMany([1]));
assertType('Tests\Types\Fakes\User', $builder->findOrFail(1));
assertType('Tests\Types\Fakes\User', $builder->findOrNew(1));
assertType('string|Tests\Types\Fakes\User', $builder->findOr(1, fn () =>'foo-bar'));
assertType('string|Tests\Types\Fakes\User', $builder->findOr(1, ['*'], fn () =>'foo-bar'));
assertType('Illuminate\Database\Eloquent\Collection<int, Tests\Types\Fakes\User>', $builder->findOr([1], ['*'], fn () =>'foo-bar'));
assertType('Tests\Types\Fakes\User', $builder->firstOrNew());
assertType('Tests\Types\Fakes\User', $builder->firstOrCreate());
assertType('Tests\Types\Fakes\User', $builder->createOrFirst());
assertType('Tests\Types\Fakes\User', $builder->updateOrCreate(['foo' => 'bar']));
assertType('Tests\Types\Fakes\User', $builder->firstOrFail());
assertType('string|Tests\Types\Fakes\User', $builder->firstOr(fn () => 'foo-bar'));
assertType('Tests\Types\Fakes\User', $builder->sole());
assertType('Illuminate\Database\Eloquent\Collection<int, Tests\Types\Fakes\User>', $builder->get());
assertType('array<Tests\Types\Fakes\User>', $builder->getModels());
assertType('Illuminate\Support\LazyCollection<int, Tests\Types\Fakes\User>', $builder->cursor());
assertType('Tests\Types\Fakes\User', $builder->create());
assertType('Tests\Types\Fakes\User', $builder->forceCreate(['foo-bar']));
assertType('Tests\Types\Fakes\User', $builder->forceCreateQuietly());
assertType('Tests\Types\Fakes\User', $builder->newModelInstance());
assertType('Tests\Types\Fakes\User', $builder->getModel());
assertType('bool', $builder->chunk(1, function ($param1, $param2) {
    assertType('Illuminate\Database\Eloquent\Collection<int, Tests\Types\Fakes\User>', $param1);
    assertType('int', $param2);
}));
assertType('Illuminate\Support\Collection<int, string>', $builder->chunkMap(function ($param1) {
    assertType('Tests\Types\Fakes\User', $param1);

    return 'foo-bar';
}));
assertType('bool', $builder->each(function ($param1, $param2) {
    assertType('Tests\Types\Fakes\User', $param1);
    assertType('int', $param2);
}));
assertType('bool', $builder->chunkById(1, function ($param1, $param2) {
    assertType('Illuminate\Database\Eloquent\Collection<int, Tests\Types\Fakes\User>', $param1);
    assertType('int', $param2);
}));
assertType('bool', $builder->chunkByIdDesc(1, function ($param1, $param2) {
    assertType('Illuminate\Database\Eloquent\Collection<int, Tests\Types\Fakes\User>', $param1);
    assertType('int', $param2);
}));
assertType('bool', $builder->orderedChunkById(1, function ($param1, $param2) {
    assertType('Illuminate\Database\Eloquent\Collection<int, Tests\Types\Fakes\User>', $param1);
    assertType('int', $param2);
}));
assertType('bool', $builder->eachById(function ($param1, $param2) {
    assertType('Tests\Types\Fakes\User', $param1);
    assertType('int', $param2);
}));
assertType('Illuminate\Support\LazyCollection<int, Tests\Types\Fakes\User>', $builder->lazy());
assertType('Illuminate\Support\LazyCollection<int, Tests\Types\Fakes\User>', $builder->lazyById());
assertType('Illuminate\Support\LazyCollection<int, Tests\Types\Fakes\User>', $builder->lazyByIdDesc());
assertType('Tests\Types\Fakes\User|null', $builder->first());
assertType('Tests\Types\Fakes\User', $builder->sole());

// Scopes
assertType('Illuminate\Database\Eloquent\Builder<Tests\Types\Fakes\User>', $builder->blocked(false));

// QueriesRelationships
assertType('Illuminate\Database\Eloquent\Builder<Tests\Types\Fakes\User>', $builder->whereHas('posts', function ($param1) {
    assertType('Illuminate\Database\Eloquent\Builder<Tests\Types\Fakes\Post>', $param1);
}));
assertType('Illuminate\Database\Eloquent\Builder<Tests\Types\Fakes\User>', $builder->whereHas('posts'));
assertType('Illuminate\Database\Eloquent\Builder<Tests\Types\Fakes\User>', $builder->whereHas('posts.category', function ($param1) {
    assertType('Illuminate\Database\Eloquent\Builder<Tests\Types\Fakes\Category>', $param1);
}));
assertType('Illuminate\Database\Eloquent\Builder<Tests\Types\Fakes\User>', $builder->whereHas('posts.category'));
assertType('Illuminate\Database\Eloquent\Builder<Tests\Types\Fakes\User>', $builder->whereHas('nonExistent', function ($param1) {
    assertType('Illuminate\Database\Eloquent\Builder<Illuminate\Database\Eloquent\Model>', $param1);
}));
assertType('Illuminate\Database\Eloquent\Builder<Tests\Types\Fakes\User>', $builder->whereHas('nonExistent'));
assertType('Illuminate\Database\Eloquent\Builder<Tests\Types\Fakes\User>', $builder->whereHas('posts.media', function ($param1) {
    assertType('Tests\Types\Fakes\Builders\MediaBuilder', $param1);
}));
assertType('Illuminate\Database\Eloquent\Builder<Tests\Types\Fakes\User>', $builder->whereHas('posts.media'));

/** @var 'posts'|'posts.category' $unionRelation */

assertType('Illuminate\Database\Eloquent\Builder<Tests\Types\Fakes\User>', $builder->whereHas($unionRelation, function ($param1) {
    assertType('Illuminate\Database\Eloquent\Builder<Tests\Types\Fakes\Category>|Illuminate\Database\Eloquent\Builder<Tests\Types\Fakes\Post>', $param1);
}));

assertType('Illuminate\Database\Eloquent\Builder<Tests\Types\Fakes\User>', $builder->whereHas($unionRelation));
