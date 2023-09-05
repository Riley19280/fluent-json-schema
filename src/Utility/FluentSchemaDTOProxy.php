<?php

namespace FluentJsonSchema\Utility;

use FluentJsonSchema\FluentSchemaDTO;

/**
 * @mixin FluentSchemaDTO
 */
class FluentSchemaDTOProxy
{
    public array $methodCalls  = [];
    public array $propertySets = [];

    private \ReflectionClass $proxyReflection;

    public function __construct(private FluentSchemaDTO $proxy)
    {
        $this->proxy->setProxy($this);
        $this->proxyReflection = new \ReflectionClass($this->proxy);
    }

    public function __call(string $name, array $arguments)
    {
        $this->methodCalls[] = $name;

        // check if the method call is a setter
        try {
            $this->proxyReflection->getMethod($name);
            $this->proxyReflection->getProperty($name);

            $this->propertySets[] = $name;
        } catch (\ReflectionException $exception) {

        }

        return $this->proxy->$name(...$arguments);
    }

    public function __get(string $name)
    {
        return $this->proxy->$name;
    }

    public function __set(string $name, $value): void
    {
        $this->propertySets[] = $name;

        $this->proxy->$name = $value;
    }
}
