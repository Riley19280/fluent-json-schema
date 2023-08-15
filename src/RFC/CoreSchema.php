<?php

namespace FluentJsonSchema\RFC;

use FluentJsonSchema\FluentSchema;

/**
 * @see https://json-schema.org/draft/2020-12/meta/core
 */
trait CoreSchema
{
    public ?string $id = null;

    public ?string $schema = null;

    public ?string $ref = null;

    public ?string $anchor = null;

    public ?string $dynamicRef = null;

    public ?string $dynamicAnchor = null;

    /**
     * @var null|array<string, FluentSchema>
     */
    public ?array $vocabulary = null;

    public ?string $comment = null;

    /**
     * @var null|array<string, FluentSchema>
     */
    public ?array $defs = null;

    public function id(string $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function schema(string $schema): static
    {
        $this->schema = $schema;

        return $this;
    }

    public function ref(string $ref): static
    {
        $this->ref = $ref;

        return $this;
    }

    public function anchor(string $anchor): static
    {
        $this->anchor = $anchor;

        return $this;
    }

    public function dynamicRef(string $dynamicRef): static
    {
        $this->dynamicRef = $dynamicRef;

        return $this;
    }

    public function dynamicAnchor(string $dynamicAnchor): static
    {
        $this->dynamicAnchor = $dynamicAnchor;

        return $this;
    }

    /**
     * @param array<string, FluentSchema> $vocabulary
     *
     * @return $this
     */
    public function vocabulary(array $vocabulary): static
    {
        $this->vocabulary = $vocabulary;

        return $this;
    }

    public function comment(string $comment): static
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * @param array<string, FluentSchema> $defs
     *
     * @return $this
     */
    public function defs(array $defs): static
    {
        $this->defs = $defs;

        return $this;
    }
}
