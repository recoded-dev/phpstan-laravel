<?php

declare(strict_types=1);

namespace Recoded\PHPStanLaravel\Extensions\Container;

use PhpParser\Node\Expr\FuncCall;
use PHPStan\Analyser\Scope;
use PHPStan\Reflection\FunctionReflection;
use PHPStan\Type\Constant\ConstantStringType;
use PHPStan\Type\DynamicFunctionReturnTypeExtension;
use PHPStan\Type\MixedType;
use PHPStan\Type\ObjectType;
use PHPStan\Type\Type;
use PHPStan\Type\TypeCombinator;
use Recoded\PHPStanLaravel\DependencyRegistry;

final class AppResolveFunctionDynamicReturnType implements DynamicFunctionReturnTypeExtension
{
    public function __construct(private DependencyRegistry $dependencyRegistry)
    {
        //
    }

    public function isFunctionSupported(FunctionReflection $functionReflection): bool
    {
        return in_array($functionReflection->getName(), ['app', 'resolve'], true);
    }

    public function getTypeFromFunctionCall(FunctionReflection $functionReflection, FuncCall $functionCall, Scope $scope): ?Type
    {
        if ($functionCall->getArgs() === []) {
            return new ObjectType('Illuminate\Contracts\Foundation\Application');
        }

        $firstArg = array_values($functionCall->getArgs())[0];
        $firstArgType = $scope->getType($firstArg->value);

        if ($firstArgType->isNull()->yes()) {
            return new ObjectType('Illuminate\Contracts\Foundation\Application');
        }

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

        // TODO preferred
        // $methodReflection = $scope->getMethodReflection(
        //     new ObjectType('Illuminate\Container\Container'),
        //     'make',
        // );
        //
        // if ($methodReflection === null) {
        //     return new MixedType();
        // }
        //
        // $variant = ParametersAcceptorSelector::selectFromArgs(
        //     $scope,
        //     $functionCall->getArgs(),
        //     $methodReflection->getVariants(),
        // );
        //
        // dd($variant->getReturnType());
        //
        // return ParametersAcceptorSelector::selectFromArgs(
        //     $scope,
        //     $functionCall->getArgs(),
        //     $methodReflection->getVariants(),
        // )->getReturnType();
    }
}
