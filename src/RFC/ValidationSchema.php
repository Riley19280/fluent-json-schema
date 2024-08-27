<?php

namespace FluentJsonSchema\RFC;

use FluentJsonSchema\Enums\JsonSchemaType;
use FluentJsonSchema\Exceptions\NonNegativeIntegerException;

/**
 * @see https://json-schema.org/draft/2020-12/meta/validation
 */
trait ValidationSchema
{
    /**
     * @var null|JsonSchemaType[]
     */
    public ?array $type                    = null;
    public mixed $const                    = null;
    public ?array $enum                    = null;
    public ?int $multipleOf                = null;
    public ?int $maximum                   = null;
    public ?int $exclusiveMaximum          = null;
    public ?int $minimum                   = null;
    public ?int $exclusiveMinimum          = null;
    public ?int $maxLength                 = null;
    public ?int $minLength                 = null;
    public ?string $pattern                = null;
    public ?int $maxItems                  = null;
    public ?int $minItems                  = null;
    public ?bool $uniqueItems              = null;
    public ?int $maxContains               = null;
    public ?int $minContains               = null;
    public ?int $maxProperties             = null;
    public ?int $minProperties             = null;

    /**
     * @var null|string[]
     */
    public ?array $required                = null;

    /**
     * @var null|array<string, string[]>
     */
    public ?array $dependentRequired = null;

    /**
     * @param JsonSchemaType $type
     *
     * @return $this
     */
    public function type(JsonSchemaType $type): static
    {
        if (is_array($this->type)) {
            if (count(array_filter($this->type, fn(JsonSchemaType $t) => $t == $type)) === 0) {
                $this->type[] = $type;
            }
        } else {
            $this->type = [$type];
        }

        return $this;
    }

    public function const(mixed $const): static
    {
        $this->const = $const;

        return $this;
    }

    public function enum(array $enum): static
    {
        $this->enum = $enum;

        return $this;
    }

    public function multipleOf(int $multipleOf): static
    {
        $this->multipleOf = $multipleOf;

        return $this;
    }

    public function maximum(int $maximum): static
    {
        $this->maximum = $maximum;

        return $this;
    }

    public function exclusiveMaximum(int $exclusiveMaximum): static
    {
        $this->exclusiveMaximum = $exclusiveMaximum;

        return $this;
    }

    public function minimum(int $minimum): static
    {
        $this->minimum = $minimum;

        return $this;
    }

    public function exclusiveMinimum(int $exclusiveMinimum): static
    {
        $this->exclusiveMinimum = $exclusiveMinimum;

        return $this;
    }

    public function maxLength(int $maxLength): static
    {
        if ($maxLength < 0) {
            throw new NonNegativeIntegerException;
        }

        $this->maxLength = $maxLength;

        return $this;
    }

    public function minLength(int $minLength): static
    {
        if ($minLength < 0) {
            throw new NonNegativeIntegerException;
        }

        $this->minLength = $minLength;

        return $this;
    }

    public function pattern(string $pattern): static
    {
        $this->pattern = $pattern;

        return $this;
    }

    public function maxItems(int $maxItems): static
    {
        $this->maxItems = $maxItems;

        return $this;
    }

    public function minItems(int $minItems): static
    {
        $this->minItems = $minItems;

        return $this;
    }

    public function uniqueItems(bool $uniqueItems): static
    {
        $this->uniqueItems = $uniqueItems;

        return $this;
    }

    public function maxContains(int $maxContains): static
    {
        if ($maxContains < 0) {
            throw new NonNegativeIntegerException;
        }

        $this->maxContains = $maxContains;

        return $this;
    }

    public function minContains(int $minContains): static
    {
        if ($minContains < 0) {
            throw new NonNegativeIntegerException;
        }

        $this->minContains = $minContains;

        return $this;
    }

    public function maxProperties(int $maxProperties): static
    {
        if ($maxProperties < 0) {
            throw new NonNegativeIntegerException;
        }

        $this->maxProperties = $maxProperties;

        return $this;
    }

    public function minProperties(int $minProperties): static
    {
        if ($minProperties < 0) {
            throw new NonNegativeIntegerException;
        }

        $this->minProperties = $minProperties;

        return $this;
    }

    /**
     * @param string[] $required
     *
     * @return $this
     */
    public function required(array $required): static
    {
        $this->required = $required;

        return $this;
    }

    /**
     * @param array<string, string[]> $dependentRequired
     *
     * @return $this
     */
    public function dependentRequired(array $dependentRequired): static
    {
        $this->dependentRequired = $dependentRequired;

        return $this;
    }
}
