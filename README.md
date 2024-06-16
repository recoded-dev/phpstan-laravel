# PHPStan Laravel

Help PHPStan understand Laravel magic.

## Usage

### Installation
``` bash
composer require --dev recoded-dev/phpstan-laravel
```

You might get asked whether you want to trust the `phpstan/extension-installer` package: 
```
Do you trust "phpstan/extension-installer" to execute code and wish to enable it now? (writes "allow-plugins" to composer.json) [y,n,d,?]
```
This is safe to trust and is used to automatically include phpstan-laravel in PHPStan.
If you don't want this you can always add the following snippet to you phpstan.neon(.dist) file:
```neon
includes:
    - vendor/recoded-dev/phpstan-laravel/extension.neon
```

### Examples
What does phpstan-laravel add?

#### Scopes
It will help understand scopes on builders.
```php
<?php

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    /**
     * Query only images.
     * 
     * @param \Illuminate\Database\Eloquent\Builder<static> $builder
     * @param bool $exceptWebp
     * @return void
     */
    public function scopeImages(Builder $builder, bool $exceptWebp): void
    {
        $builder->where('mime_type', 'LIKE', 'image/%');    
    }
}

Media::query()->images()->count();
```

Will report:
```
Method Media::images() invoked with 0 parameters, 1 required.
```

#### Relational queries
It will help understand what (custom) builder type is given in callbacks of relational queries:

```php
<?php

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    /**
     * Query only thumbnail.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<Post, Media>
     */
    public function thumbnail(): BelongsTo
    {
        return $this->belongsTo(Media::class);
    }
}

/**
 * @extends \Illuminate\Database\Eloquent\Builder<Media>
 */
class MediaBuilder extends Builder
{
    // Add custom methods/"scopes" here.
}

class Media extends Model
{
    public function newEloquentBuilder($query): MediaBuilder
    {
        return new MediaBuilder($query);
    }
}

Post::query()
    ->whereHas('thumbnail', function ($builder) {
        \PHPStan\dumpType($builder);
    })
    ->count();
```

Will report:
```
Dumped type: MediaBuilder
```

And allows you to call methods on your custom builder.

#### Dependency resolving
It will help understand what types are resolved from the container:

```php
<?php

class MyService
{
    //
}

\PHPStan\dumpType(app());
\PHPStan\dumpType(app(MyService::class));
\PHPStan\dumpType(app('auth'));
```

Will report:
```
Dumped type: Illuminate\Contracts\Foundation\Application
Dumped type: MyService
Dumped type: Illuminate\Contracts\Auth\Factory
```

And allows you to call methods on your custom builder.

### Configuration
All configuration options fall under `parameters` > `laravel` in the neon configuration.
For example:
```neon
parameters:
    laravel:
        option: value
```

#### Custom container bindings
phpstan-laravel automatically understands it when you try to resolve class-strings from the container.
But if you have bindings based on non-class-strings, it will need to know about that in order
to provide you with the right type.

You can set this up using:
```neon
parameters:
    laravel:
        customBindings:
            foo-bar: App\Service\FooBarService
```

Now the following code will output `App\Service\FooBarService`:
```php
\PHPStan\dumpType(app('foo-bar'));
```

#### Morph map
phpstan-laravel checks whether you use the correct builder in the callback parameter
of (morph) relation queries (whereHas, whereHasMorph). However when you use a morph
map, phpstan-laravel will need to be informed about that.

You can set this up using:
```neon
parameters:
    laravel:
        morphMap:
            media: App\Models\Media
```

Now the following code will output `Illuminate\Database\Eloquent\Builder<App\Models\Media>`:
```php
$builder->whereHasMorph('model', ['media'], function ($builder) {
    \PHPStan\dumpType($builder);
});
```
This will make it so that PHPStan understands what scopes exists and verify their signatures.

## Why use this and instead of Larastan?
We're not at all claiming this package is better than Larastan. Larastan is probably more feature-rich than
this package. This package however does not boot your application, which Larastan does do. We think the
best part about static analysis is that your code isn't run.

## Contribution
Development to this package requires tests and static analysis.

To validate these locally run the following with dev dependencies installed:
```bash
vendor/bin/phpunit && vendor/bin/phpstan
```
