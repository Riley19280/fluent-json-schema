<?php

namespace FluentJsonSchema\RFC;

/**
 * @see https://json-schema.org/draft/2020-12/meta/meta-data
 */
trait MetadataSchema
{
    public ?string $title       = null;
    public ?string $description = null;
    public mixed $default       = null;
    public ?bool $deprecated    = null;
    public ?bool $readOnly      = null;
    public ?bool $writeOnly     = null;
    public ?array $examples     = null;

    public function title(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function description(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function default(string $default): static
    {
        $this->default = $default;

        return $this;
    }

    public function deprecated(string $deprecated): static
    {
        $this->deprecated = $deprecated;

        return $this;
    }

    public function readOnly(string $readOnly): static
    {
        $this->readOnly = $readOnly;

        return $this;
    }

    public function writeOnly(string $writeOnly): static
    {
        $this->writeOnly = $writeOnly;

        return $this;
    }

    public function examples(array $examples): static
    {
        $this->examples = $examples;

        return $this;
    }
}
