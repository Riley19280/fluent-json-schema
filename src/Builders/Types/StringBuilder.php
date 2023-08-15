<?php

namespace FluentJsonSchema\Builders\Types;

class StringBuilder extends AbstractTypeBuilder
{
    public function maxLength(int $maxLength): static
    {
        $this->fluentSchema->getInternal()->maxLength($maxLength);

        return $this;
    }

    public function minLength(int $minLength): static
    {
        $this->fluentSchema->getInternal()->minLength($minLength);

        return $this;
    }

    public function pattern(string $pattern): static
    {
        $this->fluentSchema->getInternal()->pattern($pattern);

        return $this;
    }
}
