<?php

namespace FluentJsonSchema\Builders\Types;

use FluentJsonSchema\Builders\FormatBuilder;
use FluentJsonSchema\FluentSchema;

class ObjectBuilder extends AbstractTypeBuilder
{
    public function format(): FormatBuilder
    {
        return new FormatBuilder($this->fluentSchema);
    }

    public function maxProperties(int $maxProperties): static
    {
        $this->fluentSchema->getInternal()->maxProperties($maxProperties);

        return $this;
    }

    public function minProperties(int $minProperties): static
    {
        $this->fluentSchema->getInternal()->minProperties($minProperties);

        return $this;
    }

    /**
     * @param string[] $required
     *
     * @return $this
     */
    public function required(array $required): static
    {
        $this->fluentSchema->getInternal()->required($required);

        return $this;
    }

    /**
     * @param array<string, string[]> $dependentRequired
     *
     * @return $this
     */
    public function dependentRequired(array $dependentRequired): static
    {
        $this->fluentSchema->getInternal()->dependentRequired($dependentRequired);

        return $this;
    }

    public function unevaluatedProperties(FluentSchema $unevaluatedProperties): static
    {
        $this->fluentSchema->getInternal()->unevaluatedProperties($unevaluatedProperties);

        return $this;
    }

    public function additionalProperties(FluentSchema $additionalProperties): static
    {
        $this->fluentSchema->getInternal()->additionalProperties($additionalProperties);

        return $this;
    }

    /**
     * @param array<string, FluentSchema> $properties
     *
     * @return $this
     */
    public function properties(array $properties): static
    {
        $this->fluentSchema->getInternal()->properties([...$this->fluentSchema->getInternal()->properties ?? [], ...$properties]);

        return $this;
    }

    /**
     * @param array<string, FluentSchema> $patternProperties
     *
     * @return $this
     */
    public function patternProperties(array $patternProperties): static
    {
        $this->fluentSchema->getInternal()->patternProperties($patternProperties);

        return $this;
    }

    /**
     * @param array<string, FluentSchema> $dependentSchemas
     *
     * @return $this
     */
    public function dependentSchemas(array $dependentSchemas): static
    {
        $this->fluentSchema->getInternal()->dependentSchemas($dependentSchemas);

        return $this;
    }

    public function propertyNames(FluentSchema $propertyNames): static
    {
        $this->fluentSchema->getInternal()->propertyNames($propertyNames);

        return $this;
    }
}
