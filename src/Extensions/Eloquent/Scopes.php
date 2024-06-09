<?php

declare(strict_types=1);

namespace Recoded\PHPStanLaravel\Extensions\Eloquent;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use PHPStan\Analyser\OutOfClassScope;
use PHPStan\Reflection\ClassReflection;
use PHPStan\Reflection\MethodReflection;
use PHPStan\Reflection\MethodsClassReflectionExtension;
use PHPStan\ShouldNotHappenException;
use PHPStan\Type\ObjectType;
use Webmozart\Assert\Assert;

final class Scopes implements MethodsClassReflectionExtension
{
    public function hasMethod(ClassReflection $classReflection, string $methodName): bool
    {
        $builderReflection = $classReflection->getAncestorWithClassName(Builder::class);

        if ($builderReflection === null) {
            return false;
        }

        $modelClass = $builderReflection->getActiveTemplateTypeMap()->getType('TModel');

        if ($modelClass === null || !(new ObjectType(Model::class))->isSuperTypeOf($modelClass)->yes()) {
            return false;
        }

        /** @var \PHPStan\Type\ObjectType $modelClass */

        $reflection = $modelClass->getClassReflection();

        if ($reflection === null) {
            throw new ShouldNotHappenException();
        }

        return $reflection->hasMethod('scope' . ucfirst($methodName));
    }

    public function getMethod(ClassReflection $classReflection, string $methodName): MethodReflection
    {
        $builderReflection = $classReflection->getAncestorWithClassName(Builder::class);

        Assert::notNull($builderReflection);

        $modelClass = $builderReflection->getActiveTemplateTypeMap()->getType('TModel');

        if ($modelClass === null || !(new ObjectType(Model::class))->isSuperTypeOf($modelClass)->yes()) {
            throw new ShouldNotHappenException();
        }

        /** @var \PHPStan\Type\ObjectType $modelClass */

        $reflection = $modelClass->getClassReflection();

        if ($reflection === null) {
            throw new ShouldNotHappenException();
        }

        if ($reflection->hasMethod('scope' . ucfirst($methodName))) {
            return new ScopeMethodReflection(
                $classReflection,
                $reflection->getMethod('scope' . ucfirst($methodName), new OutOfClassScope()),
            );
        }

        throw new ShouldNotHappenException();
    }
}
