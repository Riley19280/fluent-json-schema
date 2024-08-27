<?php

namespace FluentJsonSchema\Builders;

use FluentJsonSchema\Builders\Types\ArrayBuilder;
use FluentJsonSchema\Builders\Types\NumberBuilder;
use FluentJsonSchema\Builders\Types\ObjectBuilder;
use FluentJsonSchema\Builders\Types\StringBuilder;
use FluentJsonSchema\Concerns\FluentSchemaDTOAccessor;
use FluentJsonSchema\Enums\JsonSchemaType;
use FluentJsonSchema\Exceptions\InvalidTypeException;
use FluentJsonSchema\FluentSchema;

class TypeBuilder implements FluentSchemaDTOAccessor
{
    public function __construct(
        protected FluentSchema $fluentSchema,
    ) {}

    public function return(): FluentSchema
    {
        return $this->fluentSchema;
    }

    public function fromString(string $type): FluentSchema
    {
        $this->fluentSchema->getSchemaDTO()->type(match ($type) {
            JsonSchemaType::ARRAY->value   => JsonSchemaType::ARRAY,
            JsonSchemaType::BOOLEAN->value => JsonSchemaType::BOOLEAN,
            JsonSchemaType::INTEGER->value => JsonSchemaType::INTEGER,
            JsonSchemaType::NULL->value    => JsonSchemaType::NULL,
            JsonSchemaType::NUMBER->value  => JsonSchemaType::NUMBER,
            JsonSchemaType::OBJECT->value  => JsonSchemaType::OBJECT,
            JsonSchemaType::STRING->value  => JsonSchemaType::STRING,
            default                        => throw new InvalidTypeException($type)
        });

        return $this->fluentSchema;
    }

    public function array(): ArrayBuilder
    {
        $this->fluentSchema->getSchemaDTO()->type(JsonSchemaType::ARRAY);

        return new ArrayBuilder($this->fluentSchema);
    }

    public function boolean(): FluentSchema
    {
        $this->fluentSchema->getSchemaDTO()->type(JsonSchemaType::BOOLEAN);

        return $this->fluentSchema;
    }

    public function integer(): NumberBuilder
    {
        $this->fluentSchema->getSchemaDTO()->type(JsonSchemaType::INTEGER);

        return new NumberBuilder($this->fluentSchema);
    }

    public function null(): FluentSchema
    {
        $this->fluentSchema->getSchemaDTO()->type(JsonSchemaType::NULL);

        return $this->fluentSchema;
    }

    public function number(): NumberBuilder
    {
        $this->fluentSchema->getSchemaDTO()->type(JsonSchemaType::NUMBER);

        return new NumberBuilder($this->fluentSchema);
    }

    public function object(): ObjectBuilder
    {
        $this->fluentSchema->getSchemaDTO()->type(JsonSchemaType::OBJECT);

        return new ObjectBuilder($this->fluentSchema);
    }

    public function string(): StringBuilder
    {
        $this->fluentSchema->getSchemaDTO()->type(JsonSchemaType::STRING);

        return new StringBuilder($this->fluentSchema);
    }
}
