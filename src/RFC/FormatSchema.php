<?php

namespace FluentJsonSchema\RFC;

trait FormatSchema
{
    public ?string $format = null;

    public function format(string $format): static
    {
        $this->format = $format;

        return $this;
    }
}
