<?php

declare(strict_types=1);

namespace Recoded\PHPStanLaravel\Extensions\Eloquent;

use PHPStan\Reflection\ClassMemberReflection;
use PHPStan\Reflection\ClassReflection;
use PHPStan\Reflection\FunctionVariant;
use PHPStan\Reflection\FunctionVariantWithPhpDocs;
use PHPStan\Reflection\MethodReflection;
use PHPStan\Reflection\ParametersAcceptor;
use PHPStan\TrinaryLogic;
use PHPStan\Type\StaticType;
use PHPStan\Type\Type;
use PHPStan\Type\VoidType;

final class ScopeMethodReflection implements MethodReflection
{
    public function __construct(
        public readonly ClassReflection $calledOn,
        public readonly MethodReflection $scopeMethodReflection,
    ) {
        //
    }

    public function getDeclaringClass(): ClassReflection
    {
        return $this->scopeMethodReflection->getDeclaringClass();
    }

    public function isStatic(): bool
    {
        return $this->scopeMethodReflection->isStatic();
    }

    public function isPrivate(): bool
    {
        return $this->scopeMethodReflection->isPrivate();
    }

    public function isPublic(): bool
    {
        return $this->scopeMethodReflection->isPublic();
    }

    public function getDocComment(): ?string
    {
        return $this->scopeMethodReflection->getDocComment();
    }

    public function getName(): string
    {
        $name = $this->scopeMethodReflection->getName();

        return strtolower($name[5]) . substr($name, 6);
    }

    public function getPrototype(): ClassMemberReflection
    {
        return $this->scopeMethodReflection->getPrototype();
    }

    /**
     * @return \PHPStan\Reflection\ParametersAcceptor[]
     */
    public function getVariants(): array
    {
        return array_map(function (ParametersAcceptor $acceptor) {
            $returnType = $acceptor->getReturnType();

            if ((new VoidType())->isSuperTypeOf($returnType)->yes()) {
                $returnType = new StaticType($this->calledOn);
            }

            return match (true) {
                $acceptor instanceof FunctionVariantWithPhpDocs => new FunctionVariantWithPhpDocs(
                    $acceptor->getTemplateTypeMap(),
                    $acceptor->getResolvedTemplateTypeMap(),
                    array_slice($acceptor->getParameters(), 1),
                    $acceptor->isVariadic(),
                    $returnType,
                    $acceptor->getPhpDocReturnType(),
                    $acceptor->getNativeReturnType(),
                    $acceptor->getCallSiteVarianceMap(),
                ),
                $acceptor instanceof FunctionVariant => new FunctionVariant(
                    $acceptor->getTemplateTypeMap(),
                    $acceptor->getResolvedTemplateTypeMap(),
                    array_slice($acceptor->getParameters(), 1),
                    $acceptor->isVariadic(),
                    $returnType,
                    $acceptor->getCallSiteVarianceMap(),
                ),
                default => $acceptor,
            };
        }, $this->scopeMethodReflection->getVariants());
    }

    public function isDeprecated(): TrinaryLogic
    {
        return $this->scopeMethodReflection->isDeprecated();
    }

    public function getDeprecatedDescription(): ?string
    {
        return $this->scopeMethodReflection->getDeprecatedDescription();
    }

    public function isFinal(): TrinaryLogic
    {
        return $this->scopeMethodReflection->isFinal();
    }

    public function isInternal(): TrinaryLogic
    {
        return $this->scopeMethodReflection->isInternal();
    }

    public function getThrowType(): ?Type
    {
        return $this->scopeMethodReflection->getThrowType();
    }

    public function hasSideEffects(): TrinaryLogic
    {
        return $this->scopeMethodReflection->hasSideEffects();
    }
}
