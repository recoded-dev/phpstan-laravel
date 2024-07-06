<?php

declare(strict_types=1);

namespace Recoded\PHPStanLaravel\Extensions\Eloquent;

use PhpParser\Node\Expr\MethodCall;
use PHPStan\Analyser\OutOfClassScope;
use PHPStan\Analyser\Scope;
use PHPStan\Reflection\MethodReflection;
use PHPStan\Reflection\Native\NativeParameterReflection;
use PHPStan\Reflection\ParameterReflection;
use PHPStan\Reflection\ParametersAcceptorSelector;
use PHPStan\Reflection\PassedByReference;
use PHPStan\ShouldNotHappenException;
use PHPStan\Type\Constant\ConstantStringType;
use PHPStan\Type\ClosureType;
use PHPStan\Type\Generic\GenericObjectType;
use PHPStan\Type\MethodParameterClosureTypeExtension;
use PHPStan\Type\ObjectType;
use PHPStan\Type\Type;
use PHPStan\Type\TypeCombinator;
use PHPStan\Type\VoidType;

final class WhereHasBuilderType implements MethodParameterClosureTypeExtension
{
    public function isMethodSupported(MethodReflection $methodReflection, ParameterReflection $parameter): bool
    {
        $methods = [
            'doesntHave',
            'has',
            'orWhereDoesntHave',
            'orWhereHas',
            'whereDoesntHave',
            'whereHas',
            'withWhereHas',
        ];

        if (!in_array($methodReflection->getName(), $methods, true)) {
            return false;
        }

        return $parameter->getName() === 'callback'
            && $methodReflection->getDeclaringClass()->is('Illuminate\Database\Eloquent\Builder');
    }

    public function getTypeFromMethodCall(MethodReflection $methodReflection, MethodCall $methodCall, ParameterReflection $parameter, Scope $scope): ?Type
    {
        $firstType = $scope->getType($methodCall->getArgs()[0]->value);

        $strings = $firstType->getConstantStrings();

        if ($strings === []) {
            return null;
        }

        $model = $methodReflection->getDeclaringClass()
            ->getActiveTemplateTypeMap()
            ->getType('TModel');

        if ($model === null || !$model->isObject()->yes()) {
            return null;
        }

        /** @var \PHPStan\Type\ObjectType $model */

        $class = $model->getClassReflection();

        if ($class === null) {
            return null;
        }

        $builderTypes = array_map(function (ConstantStringType $firstType) use ($scope, $class) {
            $relationName = $firstType->getValue();

            $relationParts = explode('.', $relationName);

            $firstPart = array_shift($relationParts);

            if (!$class->hasMethod($firstPart)) {
                return null;
            }

            $relation = $class->getMethod($firstPart, new OutOfClassScope());

            $relation = array_reduce($relationParts, function (?MethodReflection $reflection, string $part) {
                if ($reflection === null) {
                    return null;
                }

                /** @var \PHPStan\Type\ObjectType $returnType */
                $returnType = ParametersAcceptorSelector::selectSingle($reflection->getVariants())->getReturnType();

                $class = $returnType->getClassReflection();

                if ($class === null) {
                    throw new ShouldNotHappenException();
                }

                /** @var \PHPStan\Type\ObjectType $related */
                $related = $class
                    ->getActiveTemplateTypeMap()
                    ->getType('TRelatedModel');

                $class = $related->getClassReflection();

                if ($class === null) {
                    throw new ShouldNotHappenException();
                }

                return $class->hasMethod($part)
                    ? $class->getMethod($part, new OutOfClassScope())
                    : null;
            }, $relation);

            if ($relation === null) {
                return null;
            }

            /** @var \PHPStan\Type\ObjectType $returnType */
            $returnType = ParametersAcceptorSelector::selectSingle($relation->getVariants())->getReturnType();

            $class = $returnType->getClassReflection();

            if ($class === null) {
                return null;
            }

            /** @var \PHPStan\Type\ObjectType $related */
            $related = $class
                ->getActiveTemplateTypeMap()
                ->getType('TRelatedModel');

            /** @var \PHPStan\Reflection\ExtendedMethodReflection $newEloquentBuilder */
            $newEloquentBuilder = $scope->getMethodReflection($related, 'newEloquentBuilder');

            return ParametersAcceptorSelector::selectSingle($newEloquentBuilder->getVariants())->getReturnType();
        }, $strings);

        $builderTypes = array_filter($builderTypes);

        $builderType = $builderTypes === []
            ? new GenericObjectType('Illuminate\Database\Eloquent\Builder', [new ObjectType('Illuminate\Database\Eloquent\Model')])
            : TypeCombinator::union(...$builderTypes);

        return new ClosureType([
            new NativeParameterReflection('callback', false, $builderType, PassedByReference::createNo(), false, null),
        ], new VoidType());
    }
}
