<?php

namespace FluentJsonSchema;

trait FluentSchemaComposition
{
    public function if(FluentSchema $if): static
    {
        $this->getInternal()->if($if);

        return $this;
    }

    public function then(FluentSchema $then): static
    {
        $this->getInternal()->then($then);

        return $this;
    }

    public function else(FluentSchema $else): static
    {
        $this->getInternal()->else($else);

        return $this;
    }

    public function allOf(array $allOf): static
    {
        $this->getInternal()->allOf($allOf);

        return $this;
    }

    public function anyOf(array $anyOf): static
    {
        $this->getInternal()->anyOf($anyOf);

        return $this;
    }

    public function oneOf(array $oneOf): static
    {
        $this->getInternal()->oneOf($oneOf);

        return $this;
    }

    public function not(FluentSchema $not): static
    {
        $this->getInternal()->not($not);

        return $this;
    }
}
