<?php

declare(strict_types=1);

namespace Recoded\PHPStanLaravel\Extensions\Eloquent;

use PhpParser\Node\Expr\MethodCall;
use PHPStan\Analyser\Scope;
use PHPStan\Reflection\MethodReflection;
use PHPStan\Reflection\ParametersAcceptorSelector;
use PHPStan\Type\ArrayType;
use PHPStan\Type\DynamicMethodReturnTypeExtension;
use PHPStan\Type\Generic\GenericObjectType;
use PHPStan\Type\IntegerType;
use PHPStan\Type\ObjectType;
use PHPStan\Type\Type;

final class BuilderCollectionDynamicReturnType implements DynamicMethodReturnTypeExtension
{
    public function getClass(): string
    {
        return 'Illuminate\Contracts\Database\Eloquent\Builder';
    }

    public function isMethodSupported(MethodReflection $methodReflection): bool
    {
        $modelType = $methodReflection
            ->getDeclaringClass()
            ->getAncestorWithClassName('Illuminate\Contracts\Database\Eloquent\Builder')
            ?->getActiveTemplateTypeMap()
            ->getType('TModel');

        if ($modelType === null) {
            return false;
        }

        $model = new ObjectType('Illuminate\Database\Eloquent\Model');

        if (!$model->isSuperTypeOf($modelType)->yes()) {
            return false;
        }

        foreach ($methodReflection->getVariants() as $variant) {
            $eloquentCollection = new GenericObjectType('Illuminate\Database\Eloquent\Collection', [
                new IntegerType(),
                $modelType,
            ]);

            if ($eloquentCollection->isSuperTypeOf($variant->getReturnType())->yes()) {
                return true;
            }
        }

        return false;
    }

    public function getTypeFromMethodCall(MethodReflection $methodReflection, MethodCall $methodCall, Scope $scope): ?Type
    {
        /** @var \PHPStan\Type\ObjectType $modelType */
        $modelType = $methodReflection
            ->getDeclaringClass()
            ->getAncestorWithClassName('Illuminate\Contracts\Database\Eloquent\Builder')
            ?->getActiveTemplateTypeMap()
            ->getType('TModel');

        $regularReturnType = ParametersAcceptorSelector::selectFromArgs(
            $scope,
            $methodCall->getArgs(),
            $methodReflection->getVariants()
        )->getReturnType();

        $eloquentCollection = new GenericObjectType('Illuminate\Database\Eloquent\Collection', [
            new IntegerType(),
            $modelType,
        ]);

        if (!$eloquentCollection->isSuperTypeOf($regularReturnType)->yes()) {
            return null;
        }

        $newCollectionReflection = $scope->getMethodReflection($modelType, 'newCollection');

        if ($newCollectionReflection === null) {
            return null;
        }

        $variant = ParametersAcceptorSelector::selectFromTypes([
            new ArrayType(new IntegerType(), $modelType),
        ], $newCollectionReflection->getVariants(), false);

        return $variant->getReturnType();
    }
}
