<?php

namespace FluentJsonSchema\Builders\Types;

class NumberBuilder extends AbstractTypeBuilder
{
    public function multipleOf(int $multipleOf): static
    {
        $this->fluentSchema->getSchemaDTO()->multipleOf($multipleOf);

        return $this;
    }

    public function maximum(int $maximum): static
    {
        $this->fluentSchema->getSchemaDTO()->maximum($maximum);

        return $this;
    }

    public function exclusiveMaximum(int $exclusiveMaximum): static
    {
        $this->fluentSchema->getSchemaDTO()->exclusiveMaximum($exclusiveMaximum);

        return $this;
    }

    public function minimum(int $minimum): static
    {
        $this->fluentSchema->getSchemaDTO()->minimum($minimum);

        return $this;
    }

    public function exclusiveMinimum(int $exclusiveMinimum): static
    {
        $this->fluentSchema->getSchemaDTO()->exclusiveMinimum($exclusiveMinimum);

        return $this;
    }
}
