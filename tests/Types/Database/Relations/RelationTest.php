<?php declare(strict_types = 1);

namespace Tests\Types\Database\Relations;

use PHPStan\Testing\TypeInferenceTestCase;
use PHPUnit\Framework\Attributes\DataProvider;

final class RelationTest extends TypeInferenceTestCase
{
    /**
     * @return iterable<string, mixed[]>
     */
    public static function fileAsserts(): iterable
    {
        yield from self::gatherAssertTypes(__DIR__ . '/../../data/database/eloquent/relations/belongs-to.php');
        yield from self::gatherAssertTypes(__DIR__ . '/../../data/database/eloquent/relations/belongs-to-many.php');
        yield from self::gatherAssertTypes(__DIR__ . '/../../data/database/eloquent/relations/has-one-or-many.php');
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
        return [__DIR__ . '/../../../../extension.neon'];
    }
}
