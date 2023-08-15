<?php

namespace FluentJsonSchema\Builders;

use FluentJsonSchema\FluentSchema;

class ContentBuilder
{
    public function __construct(
        protected FluentSchema $fluentSchema,
    ) {
    }

    public function encoding(string $contentEncoding): FluentSchema
    {
        $this->fluentSchema->getInternal()->contentEncoding($contentEncoding);

        return $this->fluentSchema;
    }

    public function mediaType(string $contentMediaType): FluentSchema
    {
        $this->fluentSchema->getInternal()->contentMediaType($contentMediaType);

        return $this->fluentSchema;
    }

    public function schema(FluentSchema $contentSchema): FluentSchema
    {
        $this->fluentSchema->getInternal()->contentSchema($contentSchema);

        return $this->fluentSchema;
    }
}
