<?php

namespace FluentJsonSchema\Builders\Types;

use FluentJsonSchema\Concerns\FluentSchemaDTOAccessor;
use FluentJsonSchema\Exceptions\NonNegativeIntegerException;
use FluentJsonSchema\FluentSchema;

class ArrayBuilder extends AbstractTypeBuilder
{
    public function maxItems(int $maxItems): static
    {
        $this->fluentSchema->getSchemaDTO()->maxItems($maxItems);

        return $this;
    }

    public function minItems(int $minItems): static
    {
        $this->fluentSchema->getSchemaDTO()->minItems($minItems);

        return $this;
    }

    public function uniqueItems(bool $uniqueItems = true): static
    {
        $this->fluentSchema->getSchemaDTO()->uniqueItems($uniqueItems);

        return $this;
    }

    /**
     * @throws NonNegativeIntegerException
     */
    public function maxContains(int $maxContains): static
    {
        $this->fluentSchema->getSchemaDTO()->maxContains($maxContains);

        return $this;
    }

    /**
     * @throws NonNegativeIntegerException
     */
    public function minContains(int $minContains): static
    {
        $this->fluentSchema->getSchemaDTO()->minContains($minContains);

        return $this;
    }

    public function unevaluatedItems(FluentSchemaDTOAccessor $unevaluatedItems): static
    {
        if (!$unevaluatedItems instanceof FluentSchema) {
            $unevaluatedItems = $unevaluatedItems->return();
        }

        $this->fluentSchema->getSchemaDTO()->unevaluatedItems($unevaluatedItems);

        return $this;
    }

    /**
     * @param FluentSchema[] $prefixItems
     *
     * @return $this
     */
    public function prefixItems(array $prefixItems): static
    {
        $this->fluentSchema->getSchemaDTO()->prefixItems($prefixItems);

        return $this;
    }

    /**
     * @param FluentSchema[] $additionalItems
     *
     * @return $this
     */
    public function additionalItems(array $additionalItems): static
    {
        $this->fluentSchema->getSchemaDTO()->additionalItems($additionalItems);

        return $this;
    }

    public function items(FluentSchemaDTOAccessor $items): static
    {
        if (!$items instanceof FluentSchema) {
            $items = $items->return();
        }

        $this->fluentSchema->getSchemaDTO()->items($items);

        return $this;
    }

    public function contains(FluentSchemaDTOAccessor $contains): static
    {
        if (!$contains instanceof FluentSchema) {
            $contains = $contains->return();
        }

        $this->fluentSchema->getSchemaDTO()->contains($contains);

        return $this;
    }
}
