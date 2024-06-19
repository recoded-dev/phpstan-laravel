<?php

declare(strict_types=1);

namespace Recoded\PHPStanLaravel\Extensions\Contracts\Config;

use Illuminate\Contracts\Config\Repository;
use PhpParser\Node\Expr\MethodCall;
use PHPStan\Analyser\Scope;
use PHPStan\Reflection\MethodReflection;
use PHPStan\Type\Constant\ConstantStringType;
use PHPStan\Type\DynamicMethodReturnTypeExtension;
use PHPStan\Type\Type;
use PHPStan\Type\TypeCombinator;
use Recoded\PHPStanLaravel\ConfigHelper;

final class RepositoryGetDynamicReturnType implements DynamicMethodReturnTypeExtension
{
    /**
     * Create a new extension instance.
     *
     * @param \Recoded\PHPStanLaravel\ConfigHelper $configHelper
     * @return void
     */
    public function __construct(
        private ConfigHelper $configHelper,
    ) {
        //
    }

    public function getClass(): string
    {
        return Repository::class;
    }

    public function isMethodSupported(MethodReflection $methodReflection): bool
    {
        return $methodReflection->getName() === 'get';
    }

    public function getTypeFromMethodCall(MethodReflection $methodReflection, MethodCall $methodCall, Scope $scope): ?Type
    {
        if ($methodCall->getArgs() === []) {
            return null;
        }

        $firstArg = array_values($methodCall->getArgs())[0];
        $firstArgType = $scope->getType($firstArg->value);

        if ($firstArgType->getConstantStrings() === []) {
            return null;
        }

        $types = array_map(function (ConstantStringType $string) {
            return $this->configHelper->get($string->getValue());
        }, $firstArgType->getConstantStrings());

        return TypeCombinator::union(...$types);
    }
}
