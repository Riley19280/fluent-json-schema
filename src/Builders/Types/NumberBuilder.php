<?php

namespace FluentJsonSchema\Builders\Types;

class NumberBuilder extends AbstractTypeBuilder
{
    public function multipleOf(int $multipleOf): static
    {
        $this->fluentSchema->getInternal()->multipleOf($multipleOf);

        return $this;
    }

    public function maximum(int $maximum): static
    {
        $this->fluentSchema->getInternal()->maximum($maximum);

        return $this;
    }

    public function exclusiveMaximum(int $exclusiveMaximum): static
    {
        $this->fluentSchema->getInternal()->exclusiveMaximum($exclusiveMaximum);

        return $this;
    }

    public function minimum(int $minimum): static
    {
        $this->fluentSchema->getInternal()->minimum($minimum);

        return $this;
    }

    public function exclusiveMinimum(int $exclusiveMinimum): static
    {
        $this->fluentSchema->getInternal()->exclusiveMinimum($exclusiveMinimum);

        return $this;
    }
}
