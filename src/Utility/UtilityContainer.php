<?php

namespace FluentJsonSchema\Utility;

trait UtilityContainer
{
    public function setUtilityValue(UtilityValue $name, mixed $value): static
    {
        $this->utilityContainer[$name->name] = $value;

        return $this;
    }

    public function getUtilityValue(UtilityValue $name): mixed
    {
        return $this->utilityContainer[$name->name];
    }
}
