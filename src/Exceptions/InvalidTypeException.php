<?php

namespace FluentJsonSchema\Exceptions;

use Throwable;

class InvalidTypeException extends FluentSchemaException
{
    public function __construct(string $type, int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct("Type $type is not a valid type", $code, $previous);
    }
}
