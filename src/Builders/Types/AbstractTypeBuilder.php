<?php

namespace FluentJsonSchema\Builders\Types;

use FluentJsonSchema\Builders\TypeBuilder;
use FluentJsonSchema\FluentSchema;
use FluentJsonSchema\Utility\Foreachable;
use Illuminate\Support\Traits\Conditionable;
use Illuminate\Support\Traits\Macroable;

abstract class AbstractTypeBuilder
{
    use Conditionable;
    use Foreachable;
    use Macroable;

    public function __construct(
        protected FluentSchema $fluentSchema,
    ) {
    }

    /**
     * Return to the FluentSchema context
     *
     * @return FluentSchema
     */
    public function return(): FluentSchema
    {
        return $this->fluentSchema;
    }

    public function type(): TypeBuilder
    {
        return new TypeBuilder($this->fluentSchema);
    }

    public function const(mixed $value): static
    {
        $this->fluentSchema->getInternal()->const($value);

        return $this;
    }

    public function enum(array $values): static
    {
        $this->fluentSchema->getInternal()->enum($values);

        return $this;
    }
}
