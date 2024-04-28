<?php

use Illuminate\Database\Eloquent\Model;

use function PHPStan\Testing\assertType;

class User extends Model
{
    public function test(): void
    {
        /** @var \Illuminate\Database\Query\Builder $baseBuilder */

        assertType('Illuminate\Database\Eloquent\Builder<static(User)>', $this->newEloquentBuilder($baseBuilder));
        assertType('static(User)|null', $this->newEloquentBuilder($baseBuilder)->first());
        assertType('Illuminate\Database\Eloquent\Collection<int, static(User)>', $this->newEloquentBuilder($baseBuilder)->get());

        assertType('Illuminate\Database\Eloquent\Builder<static(User)>', self::query());
        assertType('static(User)|null', self::query()->first());
        assertType('Illuminate\Database\Eloquent\Collection<int, static(User)>', self::query()->get());
    }
}
