<?php

namespace FluentJsonSchema\Builders;

use FluentJsonSchema\Concerns\FluentSchemaDTOAccessor;
use FluentJsonSchema\FluentSchema;

class ContentBuilder implements FluentSchemaDTOAccessor
{
    public function __construct(
        protected FluentSchema $fluentSchema,
    ) {}

    public function return(): FluentSchema
    {
        return $this->fluentSchema;
    }

    public function encoding(string $contentEncoding): FluentSchema
    {
        $this->fluentSchema->getSchemaDTO()->contentEncoding($contentEncoding);

        return $this->fluentSchema;
    }

    public function mediaType(string $contentMediaType): FluentSchema
    {
        $this->fluentSchema->getSchemaDTO()->contentMediaType($contentMediaType);

        return $this->fluentSchema;
    }

    public function schema(FluentSchemaDTOAccessor $contentSchema): FluentSchema
    {
        if (!$contentSchema instanceof FluentSchema) {
            $contentSchema = $contentSchema->return();
        }

        $this->fluentSchema->getSchemaDTO()->contentSchema($contentSchema);

        return $this->fluentSchema;
    }
}
