<?php

namespace FluentJsonSchema;

use FluentJsonSchema\Builders\ContentBuilder;
use FluentJsonSchema\Builders\FormatBuilder;
use FluentJsonSchema\Builders\TypeBuilder;
use FluentJsonSchema\Builders\Types\ArrayBuilder;
use FluentJsonSchema\Builders\Types\NumberBuilder;
use FluentJsonSchema\Builders\Types\ObjectBuilder;
use FluentJsonSchema\Builders\Types\StringBuilder;
use FluentJsonSchema\Concerns\FluentSchemaDTOAccessor;
use FluentJsonSchema\Exceptions\FluentSchemaException;
use FluentJsonSchema\Utility\FluentSchemaDTOProxy;
use FluentJsonSchema\Utility\Foreachable;
use FluentJsonSchema\Utility\Tappable;
use Illuminate\Support\Traits\Conditionable;
use Illuminate\Support\Traits\Macroable;
use JsonSchema\Constraints\Factory;
use JsonSchema\SchemaStorage;
use JsonSchema\Validator;

/** @phpstan-consistent-constructor */
class FluentSchema implements FluentSchemaDTOAccessor
{
    use Conditionable;
    use FluentSchemaComposition;
    use FluentSchemaCore;
    use FluentSchemaMetadata;
    use Foreachable;
    use Macroable;
    use Tappable;

    protected FluentSchemaDTOProxy $fluentSchemaDTO;

    protected ?bool $evaluateTo = null;

    protected SchemaStorage $schemaStorage;

    public function __construct()
    {
        $this->fluentSchemaDTO = new FluentSchemaDTOProxy(new FluentSchemaDTO);
    }

    public static function make(): static
    {
        return new static;
    }

    /**
     * @internal
     */
    public function return(): FluentSchema
    {
        return $this;
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
     * Set the format
     *
     * @return FormatBuilder
     */
    public function format(): FormatBuilder
    {
        return new FormatBuilder($this);
    }

    /**
     * @internal
     */
    public function getSchemaDTO(): FluentSchemaDTOProxy
    {
        return $this->fluentSchemaDTO;
    }

    protected function ensureSchemaStorage(): void
    {
        if (!isset($this->schemaStorage)) {
            $this->schemaStorage = new SchemaStorage;
        }
    }

    public function getSchemaStorage(): SchemaStorage
    {
        $this->ensureSchemaStorage();

        return $this->schemaStorage;
    }

    public function setSchemaStorage(SchemaStorage $schemaStorage): static
    {
        $this->schemaStorage = $schemaStorage;

        return $this;
    }

    /**
     * Validate the json schema
     *
     * @see https://github.com/justinrainbow/json-schema
     *
     * @param array|object $data
     * @param int|null     $checkMode
     *
     * @return Validator
     */
    public function validate(mixed &$data, ?int $checkMode = null): Validator
    {
        $this->ensureSchemaStorage();

        $validator = new Validator(new Factory($this->schemaStorage));

        $validator->validate($data, $this->compile(), $checkMode);

        return $validator;
    }

    /**
     * @param object|array $schema Schema to add
     * @param string|null  $id     The id to assign to the schema, if not set in the schema itself
     *
     * @throws FluentSchemaException
     *
     * @return $this
     */
    public function addValidationSchema(object|array $schema, ?string $id = null): static
    {
        $this->ensureSchemaStorage();

        if ($schema instanceof FluentSchema) {
            $id     = $schema->getSchemaDTO()->id ?? $id;
            $schema = $schema->compile();
        }

        if (!$id) {
            throw new FluentSchemaException('Schema id was not provided');
        }

        $this->schemaStorage->addSchema($id, $schema);

        return $this;
    }

    public function customKeyword(string $keyword, mixed $value): static
    {
        $this->getSchemaDTO()->customKeyword($keyword, $value);

        return $this;
    }

    public function compile(): bool|array
    {
        if ($this->evaluateTo !== null) {
            return $this->evaluateTo;
        }

        return $this->fluentSchemaDTO->toArray();
    }
}
