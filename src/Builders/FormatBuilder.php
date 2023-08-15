<?php

namespace FluentJsonSchema\Builders;

use FluentJsonSchema\FluentSchema;

class FormatBuilder
{
    public function __construct(
        protected FluentSchema $fluentSchema,

    ) {
    }

    public function custom(string $format): FluentSchema
    {
        $this->fluentSchema->getInternal()->format($format);

        return $this->fluentSchema;
    }

    public function regex(): FluentSchema
    {
        $this->fluentSchema->getInternal()->format('regex');

        return $this->fluentSchema;
    }

    public function jsonPointer(): FluentSchema
    {
        $this->fluentSchema->getInternal()->format('json-pointer');

        return $this->fluentSchema;
    }

    public function relativeJsonPointer(): FluentSchema
    {
        $this->fluentSchema->getInternal()->format('relative-json-pointer');

        return $this->fluentSchema;
    }

    public function uriTemplate(): FluentSchema
    {
        $this->fluentSchema->getInternal()->format('uri-template');

        return $this->fluentSchema;
    }

    public function uuid(): FluentSchema
    {
        $this->fluentSchema->getInternal()->format('uuid');

        return $this->fluentSchema;
    }

    public function iriReference(): FluentSchema
    {
        $this->fluentSchema->getInternal()->format('iri-reference');

        return $this->fluentSchema;
    }

    public function iri(): FluentSchema
    {
        $this->fluentSchema->getInternal()->format('iri');

        return $this->fluentSchema;
    }

    public function uriReference(): FluentSchema
    {
        $this->fluentSchema->getInternal()->format('uri-reference');

        return $this->fluentSchema;
    }

    public function uri(): FluentSchema
    {
        $this->fluentSchema->getInternal()->format('uri');

        return $this->fluentSchema;
    }

    public function ipv4(): FluentSchema
    {
        $this->fluentSchema->getInternal()->format('ipv4');

        return $this->fluentSchema;
    }

    public function ipv6(): FluentSchema
    {
        $this->fluentSchema->getInternal()->format('ipv6');

        return $this->fluentSchema;
    }

    public function hostname(): FluentSchema
    {
        $this->fluentSchema->getInternal()->format('hostname');

        return $this->fluentSchema;
    }

    public function idnHostname(): FluentSchema
    {
        $this->fluentSchema->getInternal()->format('idn-hostname');

        return $this->fluentSchema;
    }

    public function email(): FluentSchema
    {
        $this->fluentSchema->getInternal()->format('email');

        return $this->fluentSchema;
    }

    public function idnEmail(): FluentSchema
    {
        $this->fluentSchema->getInternal()->format('idn-email');

        return $this->fluentSchema;
    }

    public function dateTime(): FluentSchema
    {
        $this->fluentSchema->getInternal()->format('date-time');

        return $this->fluentSchema;
    }

    public function date(): FluentSchema
    {
        $this->fluentSchema->getInternal()->format('date');

        return $this->fluentSchema;
    }

    public function time(): FluentSchema
    {
        $this->fluentSchema->getInternal()->format('time');

        return $this->fluentSchema;
    }

    public function duration(): FluentSchema
    {
        $this->fluentSchema->getInternal()->format('duration');

        return $this->fluentSchema;
    }
}
