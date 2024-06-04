<?php

declare(strict_types=1);

namespace Recoded\PHPStanLaravel\Extensions\Eloquent;

use PHPStan\Reflection\ClassMemberReflection;
use PHPStan\Reflection\ClassReflection;
use PHPStan\Reflection\FunctionVariant;
use PHPStan\Reflection\MethodReflection;
use PHPStan\Reflection\ParametersAcceptor;
use PHPStan\TrinaryLogic;
use PHPStan\Type\ThisType;
use PHPStan\Type\Type;

final class BuilderMixinMethodReflection implements MethodReflection
{
    /** @var \PHPStan\Reflection\ParametersAcceptor[] */
    private array $variants;

    public function __construct(
        private ClassReflection $classReflection,
        private MethodReflection $methodReflection,
    ) {
    }

    public function getDeclaringClass(): ClassReflection
    {
        return $this->classReflection;
    }

    public function isStatic(): bool
    {
        return false;
    }

    public function isPrivate(): bool
    {
        return $this->methodReflection->isPrivate();
    }

    public function isPublic(): bool
    {
        return $this->methodReflection->isPublic();
    }

    public function getDocComment(): ?string
    {
        return $this->methodReflection->getDocComment();
    }

    public function getName(): string
    {
        return $this->methodReflection->getName();
    }

    public function getPrototype(): ClassMemberReflection
    {
        return $this->methodReflection->getPrototype();
    }

    public function getVariants(): array
    {
        return $this->variants ??= array_map(
            fn (ParametersAcceptor $variant) => new FunctionVariant(
                $variant->getTemplateTypeMap(),
                $variant->getResolvedTemplateTypeMap(),
                $variant->getParameters(),
                $variant->isVariadic(),
                new ThisType($this->classReflection),
            ),
            $this->methodReflection->getVariants(),
        );
    }

    public function isDeprecated(): TrinaryLogic
    {
        return $this->methodReflection->isDeprecated();
    }

    public function getDeprecatedDescription(): ?string
    {
        return $this->methodReflection->getDeprecatedDescription();
    }

    public function isFinal(): TrinaryLogic
    {
        return $this->methodReflection->isFinal();
    }

    public function isInternal(): TrinaryLogic
    {
        return $this->methodReflection->isInternal();
    }

    public function getThrowType(): ?Type
    {
        return $this->methodReflection->getThrowType();
    }

    public function hasSideEffects(): TrinaryLogic
    {
        return $this->methodReflection->hasSideEffects();
    }
}
