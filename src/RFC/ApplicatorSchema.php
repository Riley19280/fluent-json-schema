<?php

namespace FluentJsonSchema\RFC;

use FluentJsonSchema\FluentSchema;

/**
 * @see https://json-schema.org/draft/2020-12/meta/applicator
 */
trait ApplicatorSchema
{
    /**
     * @var null|FluentSchema[]
     */
    public ?array $prefixItems = null;

    public ?FluentSchema $items = null;

    public ?FluentSchema $contains = null;

    public ?FluentSchema $additionalProperties = null;

    /**
     * @var null|array<string, FluentSchema>
     */
    public ?array $properties = null;

    /**
     * @var null|array<string, FluentSchema>
     */
    public ?array $patternProperties = null;

    /**
     * @var null|array<string, FluentSchema>
     */
    public ?array $dependentSchemas = null;

    public ?FluentSchema $propertyNames = null;

    public ?FluentSchema $if = null;

    public ?FluentSchema $then = null;

    public ?FluentSchema $else = null;

    /**
     * @var null|FluentSchema[]
     */
    public ?array $allOf = null;

    /**
     * @var null|FluentSchema[]
     */
    public ?array $anyOf = null;
    /**
     * @var null|FluentSchema[]
     */
    public ?array $oneOf = null;

    public ?FluentSchema $not = null;

    /**
     * @param FluentSchema[] $prefixItems
     *
     * @return $this
     */
    public function prefixItems(array $prefixItems): static
    {
        $this->prefixItems = $prefixItems;

        return $this;
    }

    public function items(FluentSchema $items): static
    {
        $this->items = $items;

        return $this;
    }

    public function contains(FluentSchema $contains): static
    {
        $this->contains = $contains;

        return $this;
    }

    public function additionalProperties(FluentSchema $additionalProperties): static
    {
        $this->additionalProperties = $additionalProperties;

        return $this;
    }

    /**
     * @param array<string, FluentSchema> $properties
     *
     * @return $this
     */
    public function properties(array $properties): static
    {
        $this->properties = $properties;

        return $this;
    }

    /**
     * @param array<string, FluentSchema> $patternProperties
     *
     * @return $this
     */
    public function patternProperties(array $patternProperties): static
    {
        $this->patternProperties = $patternProperties;

        return $this;
    }

    /**
     * @param array<string, FluentSchema> $dependentSchemas
     *
     * @return $this
     */
    public function dependentSchemas(array $dependentSchemas): static
    {
        $this->dependentSchemas = $dependentSchemas;

        return $this;
    }

    public function propertyNames(FluentSchema $propertyNames): static
    {
        $this->propertyNames = $propertyNames;

        return $this;
    }

    public function if(FluentSchema $if): static
    {
        $this->if = $if;

        return $this;
    }

    public function then(FluentSchema $then): static
    {
        $this->then = $then;

        return $this;
    }

    public function else(FluentSchema $else): static
    {
        $this->else = $else;

        return $this;
    }

    /**
     * @param array<string, FluentSchema> $allOf
     *
     * @return $this
     */
    public function allOf(array $allOf): static
    {
        $this->allOf = $allOf;

        return $this;
    }

    /**
     * @param array<string, FluentSchema> $anyOf
     *
     * @return $this
     */
    public function anyOf(array $anyOf): static
    {
        $this->anyOf = $anyOf;

        return $this;
    }

    /**
     * @param array<string, FluentSchema> $oneOf
     *
     * @return $this
     */
    public function oneOf(array $oneOf): static
    {
        $this->oneOf = $oneOf;

        return $this;
    }

    public function not(FluentSchema $not): static
    {
        $this->not = $not;

        return $this;
    }
}
