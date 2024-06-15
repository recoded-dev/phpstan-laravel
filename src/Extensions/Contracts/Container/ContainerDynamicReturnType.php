<?php

declare(strict_types=1);

namespace Recoded\PHPStanLaravel\Extensions\Contracts\Container;

use Illuminate\Contracts\Container\Container;
use PhpParser\Node\Expr\MethodCall;
use PHPStan\Analyser\Scope;
use PHPStan\Reflection\MethodReflection;
use PHPStan\Type\Constant\ConstantStringType;
use PHPStan\Type\DynamicMethodReturnTypeExtension;
use PHPStan\Type\MixedType;
use PHPStan\Type\Type;
use PHPStan\Type\TypeCombinator;
use Recoded\PHPStanLaravel\DependencyRegistry;

final class ContainerDynamicReturnType implements DynamicMethodReturnTypeExtension
{
    public function __construct(private DependencyRegistry $dependencyRegistry)
    {
        //
    }

    public function getClass(): string
    {
        return Container::class;
    }

    public function isMethodSupported(MethodReflection $methodReflection): bool
    {
        return in_array($methodReflection->getName(), ['make', 'makeWith', 'get'], true);
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
            $registryType = $this->dependencyRegistry->get(
                $string->getValue(),
            );

            if ($registryType !== null) {
                return $registryType;
            }

            if ($string->isClassStringType()->yes()) {
                return $string->getClassStringObjectType();
            }

            return new MixedType();
        }, $firstArgType->getConstantStrings());

        return TypeCombinator::union(...$types);
    }
}
