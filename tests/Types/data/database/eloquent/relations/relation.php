<?php

use Tests\Types\Fakes\Post;

use function PHPStan\Testing\assertType;

/** @var \Illuminate\Database\Eloquent\Relations\Relation<\Tests\Types\Fakes\Post, \Tests\Types\Fakes\User> $relation */

assertType('Illuminate\Database\Eloquent\Relations\Relation<Tests\Types\Fakes\Post, Tests\Types\Fakes\User>', $relation->take(5));
assertType('Illuminate\Database\Eloquent\Relations\Relation<Tests\Types\Fakes\Post, Tests\Types\Fakes\User>', $relation->has('posts', callback: function ($param1) {
    assertType('Illuminate\Database\Eloquent\Builder<Tests\Types\Fakes\Post>', $param1);
}));
assertType('Illuminate\Database\Eloquent\Relations\Relation<Tests\Types\Fakes\Post, Tests\Types\Fakes\User>', $relation->doesntHave('posts', callback: function ($param1) {
    assertType('Illuminate\Database\Eloquent\Builder<Tests\Types\Fakes\Post>', $param1);
}));
assertType('Illuminate\Database\Eloquent\Relations\Relation<Tests\Types\Fakes\Post, Tests\Types\Fakes\User>', $relation->whereHas('posts', function ($param1) {
    assertType('Illuminate\Database\Eloquent\Builder<Tests\Types\Fakes\Post>', $param1);
}));
assertType('Illuminate\Database\Eloquent\Relations\Relation<Tests\Types\Fakes\Post, Tests\Types\Fakes\User>', $relation->whereHas('posts'));
assertType('Illuminate\Database\Eloquent\Relations\Relation<Tests\Types\Fakes\Post, Tests\Types\Fakes\User>', $relation->whereHas('posts.category', function ($param1) {
    assertType('Illuminate\Database\Eloquent\Builder<Tests\Types\Fakes\Category>', $param1);
}));
assertType('Illuminate\Database\Eloquent\Relations\Relation<Tests\Types\Fakes\Post, Tests\Types\Fakes\User>', $relation->whereHas('posts.category'));
assertType('Illuminate\Database\Eloquent\Relations\Relation<Tests\Types\Fakes\Post, Tests\Types\Fakes\User>', $relation->whereHas('nonExistent', function ($param1) {
    assertType('Illuminate\Database\Eloquent\Builder<Illuminate\Database\Eloquent\Model>', $param1);
}));
assertType('Illuminate\Database\Eloquent\Relations\Relation<Tests\Types\Fakes\Post, Tests\Types\Fakes\User>', $relation->whereHas('nonExistent'));
assertType('Illuminate\Database\Eloquent\Relations\Relation<Tests\Types\Fakes\Post, Tests\Types\Fakes\User>', $relation->whereHas('posts.media', function ($param1) {
    assertType('Tests\Types\Fakes\Builders\MediaBuilder', $param1);
}));
assertType('Illuminate\Database\Eloquent\Relations\Relation<Tests\Types\Fakes\Post, Tests\Types\Fakes\User>', $relation->whereHas('posts.media'));

/** @var 'posts'|'posts.category' $unionRelation */

assertType('Illuminate\Database\Eloquent\Relations\Relation<Tests\Types\Fakes\Post, Tests\Types\Fakes\User>', $relation->whereHas($unionRelation, function ($param1) {
    assertType('Illuminate\Database\Eloquent\Builder<Tests\Types\Fakes\Category>|Illuminate\Database\Eloquent\Builder<Tests\Types\Fakes\Post>', $param1);
}));

assertType('Illuminate\Database\Eloquent\Relations\Relation<Tests\Types\Fakes\Post, Tests\Types\Fakes\User>', $relation->whereHas($unionRelation));

assertType('Illuminate\Database\Eloquent\Relations\Relation<Tests\Types\Fakes\Post, Tests\Types\Fakes\User>', $relation->withWhereHas('posts', function ($param1) {
    assertType('Illuminate\Database\Eloquent\Builder<Tests\Types\Fakes\Post>', $param1);
}));
assertType('Illuminate\Database\Eloquent\Relations\Relation<Tests\Types\Fakes\Post, Tests\Types\Fakes\User>', $relation->orWhereHas('posts', function ($param1) {
    assertType('Illuminate\Database\Eloquent\Builder<Tests\Types\Fakes\Post>', $param1);
}));
assertType('Illuminate\Database\Eloquent\Relations\Relation<Tests\Types\Fakes\Post, Tests\Types\Fakes\User>', $relation->whereDoesntHave('posts', function ($param1) {
    assertType('Illuminate\Database\Eloquent\Builder<Tests\Types\Fakes\Post>', $param1);
}));
assertType('Illuminate\Database\Eloquent\Relations\Relation<Tests\Types\Fakes\Post, Tests\Types\Fakes\User>', $relation->orWhereDoesntHave('posts', function ($param1) {
    assertType('Illuminate\Database\Eloquent\Builder<Tests\Types\Fakes\Post>', $param1);
}));
assertType('Illuminate\Database\Eloquent\Relations\Relation<Tests\Types\Fakes\Post, Tests\Types\Fakes\User>', $relation->hasMorph('related', [Post::class, 'media'], callback: function ($param1) {
    assertType('Illuminate\Database\Eloquent\Builder<Tests\Types\Fakes\Post>|Tests\Types\Fakes\Builders\MediaBuilder', $param1);
}));
assertType('Illuminate\Database\Eloquent\Relations\Relation<Tests\Types\Fakes\Post, Tests\Types\Fakes\User>', $relation->doesntHaveMorph('related', [Post::class, 'media'], callback: function ($param1) {
    assertType('Illuminate\Database\Eloquent\Builder<Tests\Types\Fakes\Post>|Tests\Types\Fakes\Builders\MediaBuilder', $param1);
}));
assertType('Illuminate\Database\Eloquent\Relations\Relation<Tests\Types\Fakes\Post, Tests\Types\Fakes\User>', $relation->whereHasMorph('related', [Post::class, 'media'], function ($param1) {
    assertType('Illuminate\Database\Eloquent\Builder<Tests\Types\Fakes\Post>|Tests\Types\Fakes\Builders\MediaBuilder', $param1);
}));
assertType('Illuminate\Database\Eloquent\Relations\Relation<Tests\Types\Fakes\Post, Tests\Types\Fakes\User>', $relation->orWhereHasMorph('related', [Post::class, 'media'], function ($param1) {
    assertType('Illuminate\Database\Eloquent\Builder<Tests\Types\Fakes\Post>|Tests\Types\Fakes\Builders\MediaBuilder', $param1);
}));
assertType('Illuminate\Database\Eloquent\Relations\Relation<Tests\Types\Fakes\Post, Tests\Types\Fakes\User>', $relation->whereDoesntHaveMorph('related', [Post::class, 'media'], function ($param1) {
    assertType('Illuminate\Database\Eloquent\Builder<Tests\Types\Fakes\Post>|Tests\Types\Fakes\Builders\MediaBuilder', $param1);
}));
assertType('Illuminate\Database\Eloquent\Relations\Relation<Tests\Types\Fakes\Post, Tests\Types\Fakes\User>', $relation->orWhereDoesntHaveMorph('related', [Post::class, 'media'], function ($param1) {
    assertType('Illuminate\Database\Eloquent\Builder<Tests\Types\Fakes\Post>|Tests\Types\Fakes\Builders\MediaBuilder', $param1);
}));

// Custom collections

/** @var \Illuminate\Database\Eloquent\Relations\Relation<\Tests\Types\Fakes\User, \Tests\Types\Fakes\Activity> $relation */
/** @var \Illuminate\Contracts\Support\Arrayable<array-key, mixed> $arrayable */

assertType('Tests\Types\Fakes\Collections\ActivityCollection<int>', $relation->hydrate([]));
assertType('Tests\Types\Fakes\Collections\ActivityCollection<int>', $relation->fromQuery(''));
// assertType('Tests\Types\Fakes\Collections\ActivityCollection<int>', $relation->find([]));
// assertType('Tests\Types\Fakes\Collections\ActivityCollection<int>', $relation->find($arrayable));
assertType('Tests\Types\Fakes\Collections\ActivityCollection<int>', $relation->findMany([]));
assertType('Tests\Types\Fakes\Collections\ActivityCollection<int>', $relation->findMany($arrayable));
// assertType('Tests\Types\Fakes\Collections\ActivityCollection<int>', $relation->findOrFail([]));
// assertType('Tests\Types\Fakes\Collections\ActivityCollection<int>', $relation->findOrFail($arrayable));
// assertType('Tests\Types\Fakes\Collections\ActivityCollection<int>', $relation->findOrNew([]));
// assertType('Tests\Types\Fakes\Collections\ActivityCollection<int>', $relation->findOrNew($arrayable));
// assertType('Tests\Types\Fakes\Collections\ActivityCollection<int>', $relation->findOr([]));
// assertType('Tests\Types\Fakes\Collections\ActivityCollection<int>', $relation->findOr($arrayable));
assertType('Tests\Types\Fakes\Collections\ActivityCollection<int>', $relation->get());
