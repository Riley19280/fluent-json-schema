<?php

namespace FluentJsonSchema\Builders\Types;

use FluentJsonSchema\Builders\FormatBuilder;
use FluentJsonSchema\Concerns\FluentSchemaDTOAccessor;
use FluentJsonSchema\FluentSchema;
use FluentJsonSchema\Utility\UtilityValue;

class ObjectBuilder extends AbstractTypeBuilder
{
    public function format(): FormatBuilder
    {
        return new FormatBuilder($this->fluentSchema);
    }

    public function maxProperties(int $maxProperties): static
    {
        $this->fluentSchema->getSchemaDTO()->maxProperties($maxProperties);

        return $this;
    }

    public function minProperties(int $minProperties): static
    {
        $this->fluentSchema->getSchemaDTO()->minProperties($minProperties);

        return $this;
    }

    /**
     * @param string[] $required
     *
     * @return $this
     */
    public function requiredProperties(array $required): static
    {
        $this->fluentSchema->getSchemaDTO()->required($required);

        return $this;
    }

    /**
     * @param array<string, string[]> $dependentRequired
     *
     * @return $this
     */
    public function dependentRequired(array $dependentRequired): static
    {
        $this->fluentSchema->getSchemaDTO()->dependentRequired($dependentRequired);

        return $this;
    }

    public function unevaluatedProperties(FluentSchemaDTOAccessor $unevaluatedProperties): static
    {
        if (!$unevaluatedProperties instanceof FluentSchema) {
            $unevaluatedProperties = $unevaluatedProperties->return();
        }

        $this->fluentSchema->getSchemaDTO()->unevaluatedProperties($unevaluatedProperties);

        return $this;
    }

    public function additionalProperties(FluentSchemaDTOAccessor $additionalProperties): static
    {
        if (!$additionalProperties instanceof FluentSchema) {
            $additionalProperties = $additionalProperties->return();
        }

        $this->fluentSchema->getSchemaDTO()->additionalProperties($additionalProperties);

        return $this;
    }

    /**
     * @param array<string, FluentSchema> $properties
     *
     * @return $this
     */
    public function properties(array $properties): static
    {
        foreach($properties as $name => $property) {
            $this->property($name, $property);
        }

        return $this;
    }

    public function property(string $name, FluentSchemaDTOAccessor $property): static
    {
        if (!$property instanceof FluentSchema) {
            $property = $property->return();
        }

        if ($property->getSchemaDTO()->getUtilityValue(UtilityValue::IsPropertyRequired)) {
            $this->fluentSchema->getSchemaDTO()->required([...$this->fluentSchema->getSchemaDTO()->required ?? [], $name]);
        }

        $this->fluentSchema->getSchemaDTO()->properties([...$this->fluentSchema->getSchemaDTO()->properties ?? [], $name => $property]);

        return $this;
    }

    /**
     * @param array<string, FluentSchema> $patternProperties
     *
     * @return $this
     */
    public function patternProperties(array $patternProperties): static
    {
        $this->fluentSchema->getSchemaDTO()->patternProperties($patternProperties);

        return $this;
    }

    /**
     * @param array<string, FluentSchema> $dependentSchemas
     *
     * @return $this
     */
    public function dependentSchemas(array $dependentSchemas): static
    {
        $this->fluentSchema->getSchemaDTO()->dependentSchemas($dependentSchemas);

        return $this;
    }

    public function propertyNames(FluentSchemaDTOAccessor $propertyNames): static
    {
        if (!$propertyNames instanceof FluentSchema) {
            $propertyNames = $propertyNames->return();
        }

        $this->fluentSchema->getSchemaDTO()->propertyNames($propertyNames);

        return $this;
    }
}
