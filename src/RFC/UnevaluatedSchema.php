<?php

namespace FluentJsonSchema\RFC;

use FluentJsonSchema\FluentSchema;

/**
 * @see https://json-schema.org/draft/2020-12/meta/unevaluated
 */
trait UnevaluatedSchema
{
    public ?FluentSchema $unevaluatedItems      = null;
    public ?FluentSchema $unevaluatedProperties = null;

    public function unevaluatedItems(FluentSchema $unevaluatedItems): static
    {
        $this->unevaluatedItems = $unevaluatedItems;

        return $this;
    }

    public function unevaluatedProperties(FluentSchema $unevaluatedProperties): static
    {
        $this->unevaluatedProperties = $unevaluatedProperties;

        return $this;
    }
}
