<?php

namespace FluentJsonSchema\Enums;

enum JsonSchemaType: string
{
    case ARRAY   = 'array';
    case BOOLEAN = 'boolean';
    case INTEGER = 'integer';
    case NULL    = 'null';
    case NUMBER  = 'number';
    case OBJECT  = 'object';
    case STRING  = 'string';
}
