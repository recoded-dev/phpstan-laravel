<?php

declare(strict_types=1);

namespace Tests\Types\Fakes\Collections;

use Illuminate\Database\Eloquent\Collection;

/**
 * @template TKey of array-key
 * @extends \Illuminate\Database\Eloquent\Collection<TKey, \Tests\Types\Fakes\Activity>
 */
final class ActivityCollection extends Collection
{
    //
}
