<?php

namespace FluentJsonSchema\Builders\Types;

use FluentJsonSchema\Builders\FormatBuilder;

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

    public function format(): FormatBuilder
    {
        return new FormatBuilder($this->fluentSchema);
    }
}
