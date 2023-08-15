<?php

namespace FluentJsonSchema;

trait FluentSchemaCore
{
    public function id(string $id): static
    {
        $this->getInternal()->id($id);

        return $this;
    }

    public function schema(string $schema): static
    {
        $this->getInternal()->schema($schema);

        return $this;
    }

    public function ref(string $ref): static
    {
        $this->getInternal()->ref($ref);

        return $this;
    }

    public function anchor(string $anchor): static
    {
        $this->getInternal()->anchor($anchor);

        return $this;
    }

    public function dynamicRef(string $dynamicRef): static
    {
        $this->getInternal()->dynamicRef($dynamicRef);

        return $this;
    }

    public function dynamicAnchor(string $dynamicAnchor): static
    {
        $this->getInternal()->dynamicAnchor($dynamicAnchor);

        return $this;
    }

    public function vocabulary(array $vocabulary): static
    {
        $this->getInternal()->vocabulary($vocabulary);

        return $this;
    }

    public function comment(string $comment): static
    {
        $this->getInternal()->comment($comment);

        return $this;
    }

    public function defs(array $defs): static
    {
        $this->getInternal()->defs($defs);

        return $this;
    }
}
