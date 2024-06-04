<?php

declare(strict_types=1);

namespace Recoded\PHPStanLaravel\Extensions\Eloquent;

use PhpParser\Node\Expr\MethodCall;
use PHPStan\Analyser\Scope;
use PHPStan\Reflection\MethodReflection;
use PHPStan\Reflection\Native\NativeParameterReflection;
use PHPStan\Reflection\ParameterReflection;
use PHPStan\Reflection\ParametersAcceptorSelector;
use PHPStan\Reflection\PassedByReference;
use PHPStan\Type\Constant\ConstantArrayType;
use PHPStan\Type\Constant\ConstantStringType;
use PHPStan\Type\ClosureType;
use PHPStan\Type\Generic\GenericObjectType;
use PHPStan\Type\MethodParameterClosureTypeExtension;
use PHPStan\Type\ObjectType;
use PHPStan\Type\Type;
use PHPStan\Type\TypeCombinator;
use PHPStan\Type\VoidType;

final class WhereHasMorphBuilderType implements MethodParameterClosureTypeExtension
{
    /**
     * Create a new Extension instance.
     *
     * @param array<string, class-string<\Illuminate\Database\Eloquent\Model>> $morphMap
     * @return void
     */
    public function __construct(
        private array $morphMap
    ) {
    }

    public function isMethodSupported(MethodReflection $method, ParameterReflection $parameter): bool
    {
        $methods = [
            'doesntHaveMorph',
            'hasMorph',
            'orWhereDoesntHaveMorph',
            'orWhereHasMorph',
            'whereDoesntHaveMorph',
            'whereHasMorph',
        ];

        if (!in_array($method->getName(), $methods, true)) {
            return false;
        }

        return $parameter->getName() === 'callback'
            && $method->getDeclaringClass()->is('Illuminate\Database\Eloquent\Builder');
    }

    public function getTypeFromMethodCall(MethodReflection $method, MethodCall $methodCall, ParameterReflection $parameter, Scope $scope): ?Type
    {
        $secondType = $scope->getType($methodCall->getArgs()[1]->value);

        $types = $secondType->isConstantArray()->yes()
            ? array_reduce($secondType->getConstantArrays(), fn (array $carry, ConstantArrayType $array) => [
                ...$carry,
                ...$array->getValueTypes(),
            ], [])
            : $secondType->getConstantStrings();

        $wildcardsAndNonConstantStrings = array_filter($types, function (Type $type) {
            return !$type instanceof ConstantStringType || $type->getValue() === '*';
        });

        if ($wildcardsAndNonConstantStrings !== []) {
            return null;
        }

        $classes = array_map(function (ConstantStringType $string) {
            return $string->isClassStringType()->yes()
                ? $string->getValue()
                : $this->morphMap[$string->getValue()] ?? $string->getValue();
        }, $types);

        $model = $method->getDeclaringClass()
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

        $builderTypes = array_map(function (string $class) use ($scope) {
            /** @var \PHPStan\Reflection\ExtendedMethodReflection $newEloquentBuilder */
            $newEloquentBuilder = $scope->getMethodReflection(new ObjectType($class), 'newEloquentBuilder');

            return ParametersAcceptorSelector::selectSingle($newEloquentBuilder->getVariants())->getReturnType();
        }, $classes);

        $builderTypes = array_filter($builderTypes);

        $builderType = $builderTypes === []
            ? new GenericObjectType('Illuminate\Database\Eloquent\Builder', [new ObjectType('Illuminate\Database\Eloquent\Model')])
            : TypeCombinator::union(...$builderTypes);

        return new ClosureType([
            new NativeParameterReflection('callback', false, $builderType, PassedByReference::createNo(), false, null),
        ], new VoidType());
    }
}
