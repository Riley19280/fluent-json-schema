<?php

namespace FluentJsonSchema;

trait FluentSchemaMetadata
{
    public function title(string $title): static
    {
        $this->getInternal()->title($title);

        return $this;
    }

    public function description(string $description): static
    {
        $this->getInternal()->description($description);

        return $this;
    }

    public function default(mixed $default): static
    {
        $this->getInternal()->default($default);

        return $this;
    }

    public function deprecated(bool $deprecated): static
    {
        $this->getInternal()->deprecated($deprecated);

        return $this;
    }

    public function readOnly(bool $readOnly): static
    {
        $this->getInternal()->readOnly($readOnly);

        return $this;
    }

    public function writeOnly(bool $writeOnly): static
    {
        $this->getInternal()->writeOnly($writeOnly);

        return $this;
    }

    public function examples(array $examples): static
    {
        $this->getInternal()->examples($examples);

        return $this;
    }
}
