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
            __DIR__ . '/../../stubs/database/eloquent/relations/belongs-to.stub',
            __DIR__ . '/../../stubs/database/eloquent/relations/belongs-to-many.stub',
            __DIR__ . '/../../stubs/database/eloquent/relations/has-many.stub',
            __DIR__ . '/../../stubs/database/eloquent/relations/has-one-or-many.stub',
            __DIR__ . '/../../stubs/database/eloquent/relations/relation.stub',
            __DIR__ . '/../../stubs/database/eloquent/builder.stub',
            __DIR__ . '/../../stubs/database/eloquent/model.stub',
        ];
    }
}
