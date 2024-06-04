<?php

declare(strict_types=1);

namespace Recoded\PHPStanLaravel\Extensions\Eloquent;

use Illuminate\Database\Eloquent\Model;
use PHPStan\Analyser\OutOfClassScope;
use PHPStan\Reflection\ClassReflection;
use PHPStan\Reflection\MethodReflection;
use PHPStan\Reflection\MethodsClassReflectionExtension;
use PHPStan\Reflection\ParametersAcceptorSelector;
use PHPStan\Type\ObjectType;

final class RelationMixinExtension implements MethodsClassReflectionExtension
{
    public function hasMethod(ClassReflection $classReflection, string $methodName): bool
    {
        $missing = $classReflection->is('Illuminate\Database\Eloquent\Relations\Relation')
            && $classReflection->hasNativeMethod($methodName) === false;

        if (!$missing) {
            return false;
        }

        $related = $classReflection->getActiveTemplateTypeMap()->getType('TRelated');

        if ($related === null) {
            return false;
        }

        if (!(new ObjectType('Illuminate\Database\Eloquent\Model'))->isSuperTypeOf($related)->yes()) {
            return false;
        }

        $builderMethod = $related->getMethod('newEloquentBuilder', new OutOfClassScope());

        $returnType = ParametersAcceptorSelector::selectSingle($builderMethod->getVariants())->getReturnType();

        if (!$returnType->isObject()->yes()) {
            return false;
        }

        return $returnType->hasMethod($methodName)->yes();
    }

    public function getMethod(ClassReflection $classReflection, string $methodName): MethodReflection
    {
        /** @var \PHPStan\Type\ObjectType $related */
        $related = $classReflection->getActiveTemplateTypeMap()->getType('TRelated');

        $builderMethod = $related->getMethod('newEloquentBuilder', new OutOfClassScope());

        /** @var \PHPStan\Type\ObjectType $returnType */
        $returnType = ParametersAcceptorSelector::selectSingle($builderMethod->getVariants())->getReturnType();

        $builderMethod = $returnType->getMethod($methodName, new OutOfClassScope());

        return new RelationMixinMethodReflection($classReflection, $builderMethod);
    }
}
