<?php

namespace FluentJsonSchema\Exceptions;

class NonNegativeIntegerException extends FluentSchemaException
{
    protected $message = 'Value must be non-negative';
}
