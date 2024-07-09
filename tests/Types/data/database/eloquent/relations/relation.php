<?php

use Tests\Types\Fakes\Post;

use function PHPStan\Testing\assertType;

/** @var \Illuminate\Database\Eloquent\Relations\Relation<\Tests\Types\Fakes\User, \Tests\Types\Fakes\Post> $relation */

assertType('Illuminate\Database\Eloquent\Relations\Relation<Tests\Types\Fakes\User, Tests\Types\Fakes\Post>', $relation->take(5));
assertType('Illuminate\Database\Eloquent\Relations\Relation<Tests\Types\Fakes\User, Tests\Types\Fakes\Post>', $relation->has('posts', callback: function ($param1) {
    assertType('Illuminate\Database\Eloquent\Builder<Tests\Types\Fakes\Post>', $param1);
}));
assertType('Illuminate\Database\Eloquent\Relations\Relation<Tests\Types\Fakes\User, Tests\Types\Fakes\Post>', $relation->doesntHave('posts', callback: function ($param1) {
    assertType('Illuminate\Database\Eloquent\Builder<Tests\Types\Fakes\Post>', $param1);
}));
assertType('Illuminate\Database\Eloquent\Relations\Relation<Tests\Types\Fakes\User, Tests\Types\Fakes\Post>', $relation->whereHas('posts', function ($param1) {
    assertType('Illuminate\Database\Eloquent\Builder<Tests\Types\Fakes\Post>', $param1);
}));
assertType('Illuminate\Database\Eloquent\Relations\Relation<Tests\Types\Fakes\User, Tests\Types\Fakes\Post>', $relation->whereHas('posts'));
assertType('Illuminate\Database\Eloquent\Relations\Relation<Tests\Types\Fakes\User, Tests\Types\Fakes\Post>', $relation->whereHas('posts.category', function ($param1) {
    assertType('Illuminate\Database\Eloquent\Builder<Tests\Types\Fakes\Category>', $param1);
}));
assertType('Illuminate\Database\Eloquent\Relations\Relation<Tests\Types\Fakes\User, Tests\Types\Fakes\Post>', $relation->whereHas('posts.category'));
assertType('Illuminate\Database\Eloquent\Relations\Relation<Tests\Types\Fakes\User, Tests\Types\Fakes\Post>', $relation->whereHas('nonExistent', function ($param1) {
    assertType('Illuminate\Database\Eloquent\Builder<Illuminate\Database\Eloquent\Model>', $param1);
}));
assertType('Illuminate\Database\Eloquent\Relations\Relation<Tests\Types\Fakes\User, Tests\Types\Fakes\Post>', $relation->whereHas('nonExistent'));
assertType('Illuminate\Database\Eloquent\Relations\Relation<Tests\Types\Fakes\User, Tests\Types\Fakes\Post>', $relation->whereHas('posts.media', function ($param1) {
    assertType('Tests\Types\Fakes\Builders\MediaBuilder', $param1);
}));
assertType('Illuminate\Database\Eloquent\Relations\Relation<Tests\Types\Fakes\User, Tests\Types\Fakes\Post>', $relation->whereHas('posts.media'));

/** @var 'posts'|'posts.category' $unionRelation */

assertType('Illuminate\Database\Eloquent\Relations\Relation<Tests\Types\Fakes\User, Tests\Types\Fakes\Post>', $relation->whereHas($unionRelation, function ($param1) {
    assertType('Illuminate\Database\Eloquent\Builder<Tests\Types\Fakes\Category>|Illuminate\Database\Eloquent\Builder<Tests\Types\Fakes\Post>', $param1);
}));

assertType('Illuminate\Database\Eloquent\Relations\Relation<Tests\Types\Fakes\User, Tests\Types\Fakes\Post>', $relation->whereHas($unionRelation));

assertType('Illuminate\Database\Eloquent\Relations\Relation<Tests\Types\Fakes\User, Tests\Types\Fakes\Post>', $relation->withWhereHas('posts', function ($param1) {
    assertType('Illuminate\Database\Eloquent\Builder<Tests\Types\Fakes\Post>', $param1);
}));
assertType('Illuminate\Database\Eloquent\Relations\Relation<Tests\Types\Fakes\User, Tests\Types\Fakes\Post>', $relation->orWhereHas('posts', function ($param1) {
    assertType('Illuminate\Database\Eloquent\Builder<Tests\Types\Fakes\Post>', $param1);
}));
assertType('Illuminate\Database\Eloquent\Relations\Relation<Tests\Types\Fakes\User, Tests\Types\Fakes\Post>', $relation->whereDoesntHave('posts', function ($param1) {
    assertType('Illuminate\Database\Eloquent\Builder<Tests\Types\Fakes\Post>', $param1);
}));
assertType('Illuminate\Database\Eloquent\Relations\Relation<Tests\Types\Fakes\User, Tests\Types\Fakes\Post>', $relation->orWhereDoesntHave('posts', function ($param1) {
    assertType('Illuminate\Database\Eloquent\Builder<Tests\Types\Fakes\Post>', $param1);
}));
assertType('Illuminate\Database\Eloquent\Relations\Relation<Tests\Types\Fakes\User, Tests\Types\Fakes\Post>', $relation->hasMorph('related', [Post::class, 'media'], callback: function ($param1) {
    assertType('Illuminate\Database\Eloquent\Builder<Tests\Types\Fakes\Post>|Tests\Types\Fakes\Builders\MediaBuilder', $param1);
}));
assertType('Illuminate\Database\Eloquent\Relations\Relation<Tests\Types\Fakes\User, Tests\Types\Fakes\Post>', $relation->doesntHaveMorph('related', [Post::class, 'media'], callback: function ($param1) {
    assertType('Illuminate\Database\Eloquent\Builder<Tests\Types\Fakes\Post>|Tests\Types\Fakes\Builders\MediaBuilder', $param1);
}));
assertType('Illuminate\Database\Eloquent\Relations\Relation<Tests\Types\Fakes\User, Tests\Types\Fakes\Post>', $relation->whereHasMorph('related', [Post::class, 'media'], function ($param1) {
    assertType('Illuminate\Database\Eloquent\Builder<Tests\Types\Fakes\Post>|Tests\Types\Fakes\Builders\MediaBuilder', $param1);
}));
assertType('Illuminate\Database\Eloquent\Relations\Relation<Tests\Types\Fakes\User, Tests\Types\Fakes\Post>', $relation->orWhereHasMorph('related', [Post::class, 'media'], function ($param1) {
    assertType('Illuminate\Database\Eloquent\Builder<Tests\Types\Fakes\Post>|Tests\Types\Fakes\Builders\MediaBuilder', $param1);
}));
assertType('Illuminate\Database\Eloquent\Relations\Relation<Tests\Types\Fakes\User, Tests\Types\Fakes\Post>', $relation->whereDoesntHaveMorph('related', [Post::class, 'media'], function ($param1) {
    assertType('Illuminate\Database\Eloquent\Builder<Tests\Types\Fakes\Post>|Tests\Types\Fakes\Builders\MediaBuilder', $param1);
}));
assertType('Illuminate\Database\Eloquent\Relations\Relation<Tests\Types\Fakes\User, Tests\Types\Fakes\Post>', $relation->orWhereDoesntHaveMorph('related', [Post::class, 'media'], function ($param1) {
    assertType('Illuminate\Database\Eloquent\Builder<Tests\Types\Fakes\Post>|Tests\Types\Fakes\Builders\MediaBuilder', $param1);
}));

// Custom collections

/** @var \Illuminate\Database\Eloquent\Relations\Relation<\Tests\Types\Fakes\Activity, \Tests\Types\Fakes\User, mixed> $relation */
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
