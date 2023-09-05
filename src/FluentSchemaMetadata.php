<?php

namespace FluentJsonSchema;

trait FluentSchemaMetadata
{
    public function title(string $title): static
    {
        $this->getSchemaDTO()->title($title);

        return $this;
    }

    public function description(string $description): static
    {
        $this->getSchemaDTO()->description($description);

        return $this;
    }

    public function default(mixed $default): static
    {
        $this->getSchemaDTO()->default($default);

        return $this;
    }

    public function deprecated(bool $deprecated = true): static
    {
        $this->getSchemaDTO()->deprecated($deprecated);

        return $this;
    }

    public function readOnly(bool $readOnly = true): static
    {
        $this->getSchemaDTO()->readOnly($readOnly);

        return $this;
    }

    public function writeOnly(bool $writeOnly = true): static
    {
        $this->getSchemaDTO()->writeOnly($writeOnly);

        return $this;
    }

    public function examples(array $examples): static
    {
        $this->getSchemaDTO()->examples($examples);

        return $this;
    }
}
