<?php

namespace FluentJsonSchema;

trait FluentSchemaComposition
{
    public function if(FluentSchema $if): static
    {
        $this->getSchemaDTO()->if($if);

        return $this;
    }

    public function then(FluentSchema $then): static
    {
        $this->getSchemaDTO()->then($then);

        return $this;
    }

    public function else(FluentSchema $else): static
    {
        $this->getSchemaDTO()->else($else);

        return $this;
    }

    public function allOf(array $allOf): static
    {
        $this->getSchemaDTO()->allOf($allOf);

        return $this;
    }

    public function anyOf(array $anyOf): static
    {
        $this->getSchemaDTO()->anyOf($anyOf);

        return $this;
    }

    public function oneOf(array $oneOf): static
    {
        $this->getSchemaDTO()->oneOf($oneOf);

        return $this;
    }

    public function not(FluentSchema $not): static
    {
        $this->getSchemaDTO()->not($not);

        return $this;
    }
}
