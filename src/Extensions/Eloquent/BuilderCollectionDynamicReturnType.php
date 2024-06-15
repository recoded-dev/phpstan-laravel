<?php

declare(strict_types=1);

namespace Recoded\PHPStanLaravel\Extensions\Eloquent;

use Illuminate\Contracts\Database\Eloquent\Builder;
use PhpParser\Node\Arg;
use PhpParser\Node\Expr\MethodCall;
use PHPStan\Analyser\Scope;
use PHPStan\Reflection\MethodReflection;
use PHPStan\Reflection\ParametersAcceptorSelector;
use PHPStan\Type\ArrayType;
use PHPStan\Type\DynamicMethodReturnTypeExtension;
use PHPStan\Type\Generic\GenericObjectType;
use PHPStan\Type\Generic\TemplateUnionType;
use PHPStan\Type\IntegerType;
use PHPStan\Type\ObjectType;
use PHPStan\Type\StringType;
use PHPStan\Type\Type;
use PHPStan\Type\UnionType;
use PHPStan\Type\VerbosityLevel;

final class BuilderCollectionDynamicReturnType implements DynamicMethodReturnTypeExtension
{
    public function getClass(): string
    {
        return Builder::class;
    }

    public function isMethodSupported(MethodReflection $methodReflection): bool
    {
        $modelType = $methodReflection
            ->getDeclaringClass()
            ->getAncestorWithClassName(Builder::class)
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
            ->getAncestorWithClassName(Builder::class)
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
