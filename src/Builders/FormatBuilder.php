<?php

namespace FluentJsonSchema\Builders;

use FluentJsonSchema\Concerns\FluentSchemaDTOAccessor;
use FluentJsonSchema\FluentSchema;

class FormatBuilder implements FluentSchemaDTOAccessor
{
    public function __construct(
        protected FluentSchema $fluentSchema,

    ) {}

    public function return(): FluentSchema
    {
        return $this->fluentSchema;
    }

    public function custom(string $format): FluentSchema
    {
        $this->fluentSchema->getSchemaDTO()->format($format);

        return $this->fluentSchema;
    }

    public function regex(): FluentSchema
    {
        $this->fluentSchema->getSchemaDTO()->format('regex');

        return $this->fluentSchema;
    }

    public function jsonPointer(): FluentSchema
    {
        $this->fluentSchema->getSchemaDTO()->format('json-pointer');

        return $this->fluentSchema;
    }

    public function relativeJsonPointer(): FluentSchema
    {
        $this->fluentSchema->getSchemaDTO()->format('relative-json-pointer');

        return $this->fluentSchema;
    }

    public function uriTemplate(): FluentSchema
    {
        $this->fluentSchema->getSchemaDTO()->format('uri-template');

        return $this->fluentSchema;
    }

    public function uuid(): FluentSchema
    {
        $this->fluentSchema->getSchemaDTO()->format('uuid');

        return $this->fluentSchema;
    }

    public function iriReference(): FluentSchema
    {
        $this->fluentSchema->getSchemaDTO()->format('iri-reference');

        return $this->fluentSchema;
    }

    public function iri(): FluentSchema
    {
        $this->fluentSchema->getSchemaDTO()->format('iri');

        return $this->fluentSchema;
    }

    public function uriReference(): FluentSchema
    {
        $this->fluentSchema->getSchemaDTO()->format('uri-reference');

        return $this->fluentSchema;
    }

    public function uri(): FluentSchema
    {
        $this->fluentSchema->getSchemaDTO()->format('uri');

        return $this->fluentSchema;
    }

    public function ipv4(): FluentSchema
    {
        $this->fluentSchema->getSchemaDTO()->format('ipv4');

        return $this->fluentSchema;
    }

    public function ipv6(): FluentSchema
    {
        $this->fluentSchema->getSchemaDTO()->format('ipv6');

        return $this->fluentSchema;
    }

    public function hostname(): FluentSchema
    {
        $this->fluentSchema->getSchemaDTO()->format('hostname');

        return $this->fluentSchema;
    }

    public function idnHostname(): FluentSchema
    {
        $this->fluentSchema->getSchemaDTO()->format('idn-hostname');

        return $this->fluentSchema;
    }

    public function email(): FluentSchema
    {
        $this->fluentSchema->getSchemaDTO()->format('email');

        return $this->fluentSchema;
    }

    public function idnEmail(): FluentSchema
    {
        $this->fluentSchema->getSchemaDTO()->format('idn-email');

        return $this->fluentSchema;
    }

    public function dateTime(): FluentSchema
    {
        $this->fluentSchema->getSchemaDTO()->format('date-time');

        return $this->fluentSchema;
    }

    public function date(): FluentSchema
    {
        $this->fluentSchema->getSchemaDTO()->format('date');

        return $this->fluentSchema;
    }

    public function time(): FluentSchema
    {
        $this->fluentSchema->getSchemaDTO()->format('time');

        return $this->fluentSchema;
    }

    public function duration(): FluentSchema
    {
        $this->fluentSchema->getSchemaDTO()->format('duration');

        return $this->fluentSchema;
    }
}
