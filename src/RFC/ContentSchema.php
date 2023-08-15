<?php

namespace FluentJsonSchema\RFC;

use FluentJsonSchema\FluentSchema;

/**
 * @see https://json-schema.org/draft/2020-12/meta/content
 */
trait ContentSchema
{
    public ?string $contentEncoding     = null;
    public ?string $contentMediaType    = null;
    public ?FluentSchema $contentSchema = null;

    public function contentEncoding(string $contentEncoding): static
    {
        $this->contentEncoding = $contentEncoding;

        return $this;
    }

    public function contentMediaType(string $contentMediaType): static
    {
        $this->contentMediaType = $contentMediaType;

        return $this;
    }

    public function contentSchema(FluentSchema $contentSchema): static
    {
        $this->contentSchema = $contentSchema;

        return $this;
    }
}
