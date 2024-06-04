<?php declare(strict_types = 1);

namespace Tests\Types\Database\Eloquent;

use PHPStan\Testing\TypeInferenceTestCase;
use PHPUnit\Framework\Attributes\DataProvider;

final class BuilderTest extends TypeInferenceTestCase
{
    /**
     * @return iterable<string, mixed[]>
     */
    public static function fileAsserts(): iterable
    {
        yield from self::gatherAssertTypes(__DIR__ . '/../../data/database/eloquent/builder.php');
    }

    #[DataProvider('fileAsserts')]
    public function testFileAsserts(
        string $assertType,
        string $file,
        mixed ...$args
    ): void {
        $this->assertFileAsserts($assertType, $file, ...$args);
    }

    public static function getAdditionalConfigFiles(): array
    {
        return [
            __DIR__ . '/../../../../extension.neon',
            __DIR__ . '/morph-map.neon',
        ];
    }
}
