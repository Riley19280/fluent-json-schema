<?php

namespace FluentJsonSchema;

use FluentJsonSchema\Builders\ContentBuilder;
use FluentJsonSchema\Builders\TypeBuilder;
use FluentJsonSchema\Builders\Types\ArrayBuilder;
use FluentJsonSchema\Builders\Types\NumberBuilder;
use FluentJsonSchema\Builders\Types\ObjectBuilder;
use FluentJsonSchema\Builders\Types\StringBuilder;
use FluentJsonSchema\Utility\FluentSchemaDTOProxy;
use FluentJsonSchema\Utility\Foreachable;
use Illuminate\Support\Traits\Conditionable;
use Illuminate\Support\Traits\Macroable;

class FluentSchema
{
    use Conditionable;
    use Macroable;
    use Foreachable;
    use FluentSchemaComposition;
    use FluentSchemaCore;
    use FluentSchemaMetadata;

    protected FluentSchemaDTOProxy $fluentSchemaDTO;

    protected ?bool $evaluateTo = null;

    public function __construct()
    {
        $this->fluentSchemaDTO = new FluentSchemaDTOProxy(new FluentSchemaDTO());
    }

    public static function make(): static
    {
        return new static;
    }

    /**
     * Create a true Json Schema
     *
     * @return static
     */
    public function true(): static
    {
        $this->evaluateTo = true;

        return $this;
    }

    /**
     * Create a false Json Schema
     *
     * @return static
     */
    public function false(): static
    {
        $this->evaluateTo = false;

        return $this;
    }

    /**
     * Select a type for this schema
     *
     * @return TypeBuilder
     */
    public function type(): TypeBuilder
    {
        return new TypeBuilder($this);
    }

    /**
     * Enter array context without setting the type
     *
     * @return ArrayBuilder
     */
    public function array(): ArrayBuilder
    {
        return new ArrayBuilder($this);
    }

    /**
     * Enter number context without setting the type
     *
     * @return NumberBuilder
     */
    public function integer(): NumberBuilder
    {
        return new NumberBuilder($this);
    }

    /**
     * Enter number context without setting the type
     *
     * @return NumberBuilder
     */
    public function number(): NumberBuilder
    {
        return new NumberBuilder($this);
    }

    /**
     * Enter object context without setting the type
     *
     * @return ObjectBuilder
     */
    public function object(): ObjectBuilder
    {
        return new ObjectBuilder($this);
    }

    /**
     * Enter string context without setting the type
     *
     * @return StringBuilder
     */
    public function string(): StringBuilder
    {
        return new StringBuilder($this);
    }

    /**
     * Set the content type
     *
     * @return ContentBuilder
     */
    public function content(): ContentBuilder
    {
        return new ContentBuilder($this);
    }

    /**
     * @internal
     */
    public function getInternal(): FluentSchemaDTOProxy
    {
        return $this->fluentSchemaDTO;
    }

    public function compile(): bool|array
    {
        if ($this->evaluateTo !== null) {
            return $this->evaluateTo;
        }

        return $this->fluentSchemaDTO->toArray();
    }
}
