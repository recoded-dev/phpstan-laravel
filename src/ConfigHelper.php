<?php

declare(strict_types=1);

namespace Recoded\PHPStanLaravel;

use PhpParser\Node\Stmt\Return_;
use PHPStan\Analyser\ScopeContext;
use PHPStan\Analyser\ScopeFactory;
use PHPStan\File\FileHelper;
use PHPStan\Parser\Parser;
use PHPStan\Type\Constant\ConstantArrayType;
use PHPStan\Type\IntegerType;
use PHPStan\Type\MixedType;
use PHPStan\Type\NullType;
use PHPStan\Type\Type;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use RegexIterator;

final class ConfigHelper
{
    /**
     * @var array<string, array<array-key, mixed>>
     */
    private array $structure;

    /**
     * Create a new ConfigHelper instance.
     *
     * @param list<string> $configPaths
     * @param \PHPStan\Parser\Parser $parser
     * @param \PHPStan\Analyser\ScopeFactory $scopeFactory
     * @param \PHPStan\File\FileHelper $fileHelper
     * @return void
     */
    public function __construct(
        private array $configPaths,
        private Parser $parser,
        private ScopeFactory $scopeFactory,
        private FileHelper $fileHelper,
    ) {
        //
    }

    private function load(): void
    {
        $paths = array_map($this->fileHelper->absolutizePath(...), $this->configPaths);

        foreach ($paths as $path) {
            /** @var iterable<int, \SplFileInfo> $files */
            $files = new RegexIterator(
                new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path)),
                '/\.php$/i',
            );

            foreach ($files as $file) {
                $statements = $this->parser->parseFile($file->getPathname());

                if (count($statements) !== 1 || !array_values($statements)[0] instanceof Return_) {
                    continue;
                }

                if (array_values($statements)[0]->expr === null) {
                    continue;
                }

                $configScope = $this->scopeFactory->create(ScopeContext::create($file->getPathname()));

                $type = $configScope->getType(array_values($statements)[0]->expr);

                if (!$type->isConstantArray()->yes()) {
                    continue;
                }

                /** @var \PHPStan\Type\Constant\ConstantArrayType $type */

                $configName = $file->getBasename('.php');

                $this->structure[$configName] = array_merge_recursive(
                    $this->structure[$configName] ?? [],
                    $this->parseArray($type),
                );
            }
        }
    }

    /**
     * @param \PHPStan\Type\Constant\ConstantArrayType $array
     * @return array<string, mixed>
     */
    private function parseArray(ConstantArrayType $array): array
    {
        $keys = $array->getKeyTypes();
        $values = $array->getValueTypes();

        $parsed = [];

        foreach ($keys as $index => $keyType) {
            $valueType = $values[$index];

            if ($valueType->isConstantArray()->yes()) {
                /** @var \PHPStan\Type\Constant\ConstantArrayType $valueType */

                if (!(new IntegerType())->isSuperTypeOf($valueType->getKeyType())->yes()) {
                    $valueType = $this->parseArray($valueType);
                }
            }

            foreach ($keyType->getConstantStrings() as $keyString) {
                $parsed[$keyString->getValue()] = $valueType;
            }
        }

        return $parsed;
    }

    public function get(string $path, Type $default = new NullType()): Type
    {
        if (!isset($this->structure)) {
            $this->load();
        }

        $parts = explode('.', $path);

        $value = $this->structure;

        foreach ($parts as $part) {
            if (!array_key_exists($part, $value)) {
                return $default;
            }

            $value = $value[$part];

            if (is_array($value)) {
                // TODO support returning entire config
            }

            if ($value instanceof Type) {
                return $value;
            }
        }

        return new MixedType();
    }
}
