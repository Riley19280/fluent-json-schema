<?php

namespace FluentJsonSchema\RFC;

use FluentJsonSchema\FluentSchema;

/**
 * Responsible for common properties missing from the RFC
 */
trait MiscSchema
{
    /**
     * @var null|FluentSchema[]
     */
    public ?array $additionalItems = null;

    /**
     * @param array<FluentSchema> $additionalItems
     *
     * @return $this
     */
    public function additionalItems(array $additionalItems): static
    {
        $this->additionalItems = $additionalItems;

        return $this;
    }
}
