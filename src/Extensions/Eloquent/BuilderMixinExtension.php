<?php

declare(strict_types=1);

namespace Recoded\PHPStanLaravel\Extensions\Eloquent;

use PHPStan\Analyser\OutOfClassScope;
use PHPStan\Reflection\ClassReflection;
use PHPStan\Reflection\MethodReflection;
use PHPStan\Reflection\MethodsClassReflectionExtension;
use PHPStan\Type\ObjectType;

final class BuilderMixinExtension implements MethodsClassReflectionExtension
{
    /** @var array<string, array<int, string>> */
    private array $mixinMethods = [];
    private ObjectType $queryBuilder;

    public function hasMethod(ClassReflection $classReflection, string $methodName): bool
    {
        return $classReflection->is('Illuminate\Database\Eloquent\Builder')
            && $classReflection->hasNativeMethod($methodName) === false
            && $this->queryBuilder()->hasMethod($methodName)->yes();
    }

    public function getMethod(ClassReflection $classReflection, string $methodName): MethodReflection
    {
        $scope = new OutOfClassScope();
        $methodReflection = $this->queryBuilder()->getMethod($methodName, $scope);
        $lowercaseMethodName = strtolower($methodName);

        if (in_array($lowercaseMethodName, $this->mixinMethods($classReflection), true)) {
            return $methodReflection;
        }

        return new BuilderMixinMethodReflection($classReflection, $methodReflection);
    }

    /**
     * @return array<int, string>
     */
    private function mixinMethods(ClassReflection $classReflection): array
    {
        $cacheKey = $classReflection->getCacheKey();

        if (!array_key_exists($cacheKey, $this->mixinMethods)) {
            /** @var array<int, string> $passthru */
            $passthru = $classReflection->getNativeReflection()->getDefaultProperties()['passthru'];
            $this->mixinMethods[$cacheKey] = array_map('strtolower', $passthru);
        }

        return $this->mixinMethods[$cacheKey];
    }

    private function queryBuilder(): ObjectType
    {
        return $this->queryBuilder ??= new ObjectType('Illuminate\Database\Query\Builder');
    }
}
