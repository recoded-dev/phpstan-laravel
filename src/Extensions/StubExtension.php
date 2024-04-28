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
            __DIR__ . '/../../stubs/database/eloquent/builder.stub',
        ];
    }
}
