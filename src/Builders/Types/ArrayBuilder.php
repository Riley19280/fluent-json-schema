<?php

namespace FluentJsonSchema\Builders\Types;

use FluentJsonSchema\Exceptions\NonNegativeIntegerException;
use FluentJsonSchema\FluentSchema;

class ArrayBuilder extends AbstractTypeBuilder
{
    public function maxItems(int $maxItems): static
    {
        $this->fluentSchema->getInternal()->maxItems($maxItems);

        return $this;
    }

    public function minItems(int $minItems): static
    {
        $this->fluentSchema->getInternal()->minItems($minItems);

        return $this;
    }

    public function uniqueItems(bool $uniqueItems): static
    {
        $this->fluentSchema->getInternal()->uniqueItems($uniqueItems);

        return $this;
    }

    /**
     * @throws NonNegativeIntegerException
     */
    public function maxContains(int $maxContains): static
    {
        $this->fluentSchema->getInternal()->maxContains($maxContains);

        return $this;
    }

    /**
     * @throws NonNegativeIntegerException
     */
    public function minContains(int $minContains): static
    {
        $this->fluentSchema->getInternal()->minContains($minContains);

        return $this;
    }

    public function unevaluatedItems(FluentSchema $unevaluatedItems): static
    {
        $this->fluentSchema->getInternal()->unevaluatedItems($unevaluatedItems);

        return $this;
    }

    /**
     * @param FluentSchema[] $prefixItems
     *
     * @return $this
     */
    public function prefixItems(array $prefixItems): static
    {
        $this->fluentSchema->getInternal()->prefixItems($prefixItems);

        return $this;
    }

    public function items(FluentSchema $items): static
    {
        $this->fluentSchema->getInternal()->items($items);

        return $this;
    }

    public function contains(FluentSchema $contains): static
    {
        $this->fluentSchema->getInternal()->contains($contains);

        return $this;
    }
}
