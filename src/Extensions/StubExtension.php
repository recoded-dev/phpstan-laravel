<?php

declare(strict_types=1);

namespace Recoded\PHPStanLaravel\Extensions;

use PHPStan\PhpDoc\StubFilesExtension;

final class StubExtension implements StubFilesExtension
{
    /**
     * Get stub files that should be registered.
     *
     * @return string[]
     */
    public function getFiles(): array
    {
        return [
            __DIR__ . '/../../stubs/contracts/database/eloquent/builder.stub',
            __DIR__ . '/../../stubs/contracts/database/query/builder.stub',
            __DIR__ . '/../../stubs/contracts/database/query/expression.stub',
            __DIR__ . '/../../stubs/contracts/queue/queueable-collection.stub',
            __DIR__ . '/../../stubs/contracts/support/arrayable.stub',
            __DIR__ . '/../../stubs/contracts/support/can-be-escaped-when-cast-to-string.stub',
            __DIR__ . '/../../stubs/contracts/support/jsonable.stub',
            __DIR__ . '/../../stubs/database/eloquent/concerns/queries-relationships.stub',
            __DIR__ . '/../../stubs/database/eloquent/relations/relation.stub',
            __DIR__ . '/../../stubs/database/eloquent/builder.stub',
            __DIR__ . '/../../stubs/database/eloquent/collection.stub',
            __DIR__ . '/../../stubs/database/eloquent/model.stub',
            __DIR__ . '/../../stubs/database/eloquent/model-not-found-exception.stub',
            __DIR__ . '/../../stubs/database/query/builder.stub',
            __DIR__ . '/../../stubs/database/multiple-records-found-exception.stub',
            __DIR__ . '/../../stubs/database/records-not-found-exception.stub',
            __DIR__ . '/../../stubs/support/collection.stub',
            __DIR__ . '/../../stubs/support/enumerable.stub',
            __DIR__ . '/../../stubs/support/lazy-collection.stub',
        ];
    }
}
