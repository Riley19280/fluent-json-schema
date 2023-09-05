<?php

namespace FluentJsonSchema;

use FluentJsonSchema\Concerns\FluentSchemaDTOAccessor;

trait FluentSchemaCore
{
    public function id(string $id): static
    {
        $this->getSchemaDTO()->id($id);

        return $this;
    }

    public function schema(string $schema): static
    {
        $this->getSchemaDTO()->schema($schema);

        return $this;
    }

    public function ref(string $ref): static
    {
        $this->getSchemaDTO()->ref($ref);

        return $this;
    }

    public function anchor(string $anchor): static
    {
        $this->getSchemaDTO()->anchor($anchor);

        return $this;
    }

    public function dynamicRef(string $dynamicRef): static
    {
        $this->getSchemaDTO()->dynamicRef($dynamicRef);

        return $this;
    }

    public function dynamicAnchor(string $dynamicAnchor): static
    {
        $this->getSchemaDTO()->dynamicAnchor($dynamicAnchor);

        return $this;
    }

    /**
     * @param array<string, bool> $vocabulary
     *
     * @return $this
     */
    public function vocabulary(array $vocabulary): static
    {
        $this->getSchemaDTO()->vocabulary($vocabulary);

        return $this;
    }

    public function comment(string $comment): static
    {
        $this->getSchemaDTO()->comment($comment);

        return $this;
    }

    public function defs(array $defs): static
    {
        $this->getSchemaDTO()->defs($defs);

        return $this;
    }

    public function def(string $name, FluentSchemaDTOAccessor $def): static
    {
        if (!$def instanceof FluentSchema) {
            $def = $def->return();
        }

        $this->getSchemaDTO()->defs([...$this->getSchemaDTO()->defs ?? [], $name => $def]);

        return $this;
    }
}
