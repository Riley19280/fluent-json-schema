<?php

namespace FluentJsonSchema\Builders\Types;

use FluentJsonSchema\Builders\FormatBuilder;

class StringBuilder extends AbstractTypeBuilder
{
    public function maxLength(int $maxLength): static
    {
        $this->fluentSchema->getSchemaDTO()->maxLength($maxLength);

        return $this;
    }

    public function minLength(int $minLength): static
    {
        $this->fluentSchema->getSchemaDTO()->minLength($minLength);

        return $this;
    }

    public function pattern(string $pattern): static
    {
        $this->fluentSchema->getSchemaDTO()->pattern($pattern);

        return $this;
    }

    public function format(): FormatBuilder
    {
        return new FormatBuilder($this->fluentSchema);
    }
}
