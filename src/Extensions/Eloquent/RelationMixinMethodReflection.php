<?php

declare(strict_types=1);

namespace Recoded\PHPStanLaravel\Extensions\Eloquent;

use PHPStan\Reflection\ClassMemberReflection;
use PHPStan\Reflection\ClassReflection;
use PHPStan\Reflection\FunctionVariant;
use PHPStan\Reflection\MethodReflection;
use PHPStan\Reflection\ParametersAcceptor;
use PHPStan\TrinaryLogic;
use PHPStan\Type\NeverType;
use PHPStan\Type\ObjectType;
use PHPStan\Type\ThisType;
use PHPStan\Type\Type;

final class RelationMixinMethodReflection implements MethodReflection
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
        return $this->methodReflection->getDeclaringClass();
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
        if (isset($this->variants)) {
            return $this->variants;
        }

        $builderType = new ObjectType('Illuminate\Database\Eloquent\Builder');
        $thisType = new ThisType($this->classReflection);

        return $this->variants = array_map(
            static function (ParametersAcceptor $variant) use ($builderType, $thisType) {
                $returnsBuilder = $variant->getReturnType() instanceof NeverType === false
                    && $builderType->isSuperTypeOf($variant->getReturnType())->yes();

                return new FunctionVariant(
                    $variant->getTemplateTypeMap(),
                    $variant->getResolvedTemplateTypeMap(),
                    $variant->getParameters(),
                    $variant->isVariadic(),
                    $returnsBuilder ? $thisType : $variant->getReturnType(),
                );
            },
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
