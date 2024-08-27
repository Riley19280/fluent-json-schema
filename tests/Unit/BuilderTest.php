<?php

use FluentJsonSchema\Builders\Types\ArrayBuilder;
use FluentJsonSchema\Builders\Types\NumberBuilder;
use FluentJsonSchema\Builders\Types\ObjectBuilder;
use FluentJsonSchema\Builders\Types\StringBuilder;
use FluentJsonSchema\Exceptions\InvalidTypeException;
use FluentJsonSchema\Exceptions\NonNegativeIntegerException;
use FluentJsonSchema\FluentSchema;

describe('base methods', function() {

    test('set format methods', function($method, $expectation) {
        expect(FluentSchema::make()->object()->format()->$method()->compile())->toBe(['format' => $expectation]);
    })->with([
        ['regex', 'regex'],
        ['jsonPointer', 'json-pointer'],
        ['relativeJsonPointer', 'relative-json-pointer'],
        ['uriTemplate', 'uri-template'],
        ['uuid', 'uuid'],
        ['iriReference', 'iri-reference'],
        ['iri', 'iri'],
        ['uriReference', 'uri-reference'],
        ['uri', 'uri'],
        ['ipv4', 'ipv4'],
        ['ipv6', 'ipv6'],
        ['hostname', 'hostname'],
        ['idnHostname', 'idn-hostname'],
        ['email', 'email'],
        ['idnEmail', 'idn-email'],
        ['date', 'date'],
        ['dateTime', 'date-time'],
        ['time', 'time'],
        ['duration', 'duration'],
    ]);

    test('set custom format', function() {
        expect(FluentSchema::make()->object()->format()->custom('custom')->compile())->toBe(['format' => 'custom']);
    });

    test('const', function() {
        expect(FluentSchema::make()->object()->const('test')->return()->compile())->toBe(['const' => 'test']);
    });

    test('enum', function() {
        expect(FluentSchema::make()->object()->enum(['a', 'b'])->return()->compile())->toBe(['enum' => ['a', 'b']]);
    });
});

describe('types', function() {
    test('set types', function(string $type) {
        $builder = FluentSchema::make()->type()->$type();

        if (method_exists($builder, 'return')) {
            $builder = $builder->return();
        }

        expect($builder->compile())->toBe(['type' => $type]);
    })->with([
        'array',
        'boolean',
        'integer',
        'null',
        'number',
        'object',
        'string',
    ]);

    test('set single type', function() {
        expect(FluentSchema::make()->type()->boolean()->compile())->toBe(['type' => 'boolean'], 'Expected should not be an array');
    });

    test('set multiple types', function() {
        expect(FluentSchema::make()->type()->boolean()->type()->null()->type()->array()->type()->number()->return()->compile())->toBe(['type' => ['boolean', 'null', 'array', 'number']]);
    });

    test('types get deduplicated', function() {
        expect(FluentSchema::make()->type()->string()->type()->string()->return()->compile())->toBe(['type' => 'string']);
    });

    test('type from string', function($type) {
        $builder = FluentSchema::make()->type()->fromString($type);

        if (method_exists($builder, 'return')) {
            $builder = $builder->return();
        }

        expect($builder->compile())->toBe(['type' => $type]);
    })->with([
        'array',
        'boolean',
        'integer',
        'null',
        'number',
        'object',
        'string',
    ]);

    test('invalid type', function() {
        FluentSchema::make()->type()->fromString('invalid');
    })->throws(InvalidTypeException::class);
});

test('enter contexts', function($context, $class) {
    expect(FluentSchema::make()->$context())->toBeInstanceOf($class);
})->with([
    ['array', ArrayBuilder::class],
    ['number', NumberBuilder::class],
    ['integer', NumberBuilder::class],
    ['object', ObjectBuilder::class],
    ['string', StringBuilder::class],
]);

test('can be boolean', function($method, $result) {
    expect(FluentSchema::make()->$method()->compile())->toBe($result);
})->with([
    ['true', true],
    ['false', false],
]);

test('fluent schema core', function(string $property, array|string $expected) {
    expect(FluentSchema::make()->$property($expected)->compile())->toBe(["$$property" => $expected]);
})->with([
    ['id', 'id'],
    ['schema', 'schema'],
    ['ref', 'ref'],
    ['anchor', 'anchor'],
    ['dynamicRef', 'dynamicRef'],
    ['dynamicAnchor', 'dynamicAnchor'],
    ['vocabulary', ['vocab1', 'vocab2']],
    ['comment', 'comment'],
    ['defs', ['def1', 'def2']],
]);

test('fluent schema core def', function() {
    expect(FluentSchema::make()->def('defName', FluentSchema::make()->true())->compile())->toBe(['$defs' => ['defName' => true]]);
});

describe('fluent schema composition', function() {
    test('if', function() {
        expect(FluentSchema::make()->if(FluentSchema::make()->type()->number()->return())->compile())->toBe(['if' => ['type' => 'number']]);
    });

    test('then', function() {
        expect(FluentSchema::make()->then(FluentSchema::make()->type()->number()->return())->compile())->toBe(['then' => ['type' => 'number']]);
    });

    test('else', function() {
        expect(FluentSchema::make()->else(FluentSchema::make()->type()->number()->return())->compile())->toBe(['else' => ['type' => 'number']]);
    });

    test('not', function() {
        expect(FluentSchema::make()->not(FluentSchema::make()->type()->number()->return())->compile())->toBe(['not' => ['type' => 'number']]);
    });

    test('allOf', function() {
        expect(FluentSchema::make()->allOf([
            FluentSchema::make()->type()->number(),
            FluentSchema::make()->type()->string(),
        ])->compile())->toBe(['allOf' => [['type' => 'number'], ['type' => 'string']]]);
    });

    test('anyOf', function() {
        expect(FluentSchema::make()->anyOf([
            FluentSchema::make()->type()->number(),
            FluentSchema::make()->type()->string(),
        ])->compile())->toBe(['anyOf' => [['type' => 'number'], ['type' => 'string']]]);
    });

    test('oneOf', function() {
        expect(FluentSchema::make()->oneOf([
            FluentSchema::make()->type()->number(),
            FluentSchema::make()->type()->string(),
        ])->compile())->toBe(['oneOf' => [['type' => 'number'], ['type' => 'string']]]);
    });

});

describe('fluent schema metadata', function() {

    test('title', function() {
        expect(FluentSchema::make()->title('title')->compile())->toBe(['title' => 'title']);
    });

    test('description', function() {
        expect(FluentSchema::make()->description('description')->compile())->toBe(['description' => 'description']);
    });

    test('default', function() {
        expect(FluentSchema::make()->default('default')->compile())->toBe(['default' => 'default']);
    });

    test('deprecated', function() {
        expect(FluentSchema::make()->deprecated(true)->compile())->toBe(['deprecated' => true]);
    });

    test('readOnly', function() {
        expect(FluentSchema::make()->readOnly(true)->compile())->toBe(['readOnly' => true]);
    });

    test('writeOnly', function() {
        expect(FluentSchema::make()->writeOnly(true)->compile())->toBe(['writeOnly' => true]);
    });

    test('examples', function() {
        expect(FluentSchema::make()->examples(['test1', 'test2'])->compile())->toBe(['examples' => ['test1', 'test2']]);
    });

});

describe('content builder', function() {

    test('content encoding', function() {
        expect(FluentSchema::make()->content()->encoding('test')->compile())->toBe(['contentEncoding' => 'test']);
    });

    test('content media type', function() {
        expect(FluentSchema::make()->content()->mediaType('test')->compile())->toBe(['contentMediaType' => 'test']);
    });

    test('content schema', function() {
        expect(FluentSchema::make()->content()->schema(FluentSchema::make()->type()->number()->return())->compile())->toBe(['contentSchema' => ['type' => 'number']]);
    });

});

describe('string builder', function() {

    test('maxLength', function() {
        expect(FluentSchema::make()->type()->string()->maxLength(10)->return()->compile())->toBe(['type' => 'string', 'maxLength' => 10]);
    });

    test('minLength', function() {
        expect(FluentSchema::make()->type()->string()->minLength(10)->return()->compile())->toBe(['type' => 'string', 'minLength' => 10]);
    });

    test('pattern', function() {
        expect(FluentSchema::make()->type()->string()->pattern('^[a-z]$')->return()->compile())->toBe(['type' => 'string', 'pattern' => '^[a-z]$']);
    });

    test('format', function() {
        expect(FluentSchema::make()->type()->string()->format()->regex()->compile())->toBe(['type' => 'string', 'format' => 'regex']);
    });

});

describe('number builder', function() {

    test('multipleOf', function() {
        expect(FluentSchema::make()->type()->number()->multipleOf(10)->return()->compile())->toBe(['type' => 'number', 'multipleOf' => 10]);
    });

    test('maximum', function() {
        expect(FluentSchema::make()->type()->number()->maximum(10)->return()->compile())->toBe(['type' => 'number', 'maximum' => 10]);
    });

    test('exclusiveMaximum', function() {
        expect(FluentSchema::make()->type()->number()->exclusiveMaximum(10)->return()->compile())->toBe(['type' => 'number', 'exclusiveMaximum' => 10]);
    });

    test('minimum', function() {
        expect(FluentSchema::make()->type()->number()->minimum(10)->return()->compile())->toBe(['type' => 'number', 'minimum' => 10]);
    });

    test('exclusiveMinimum', function() {
        expect(FluentSchema::make()->type()->number()->exclusiveMinimum(10)->return()->compile())->toBe(['type' => 'number', 'exclusiveMinimum' => 10]);
    });

});

describe('array builder', function() {

    test('maxItems', function() {
        expect(FluentSchema::make()->type()->array()->maxItems(10)->return()->compile())->toBe(['type' => 'array', 'maxItems' => 10]);
    });

    test('minItems', function() {
        expect(FluentSchema::make()->type()->array()->minItems(10)->return()->compile())->toBe(['type' => 'array', 'minItems' => 10]);
    });

    test('uniqueItems', function() {
        expect(FluentSchema::make()->type()->array()->uniqueItems(false)->return()->compile())->toBe(['type' => 'array', 'uniqueItems' => false]);
    });

    test('maxContains', function() {
        expect(FluentSchema::make()->type()->array()->maxContains(10)->return()->compile())->toBe(['type' => 'array', 'maxContains' => 10]);
    });

    test('minContains', function() {
        expect(FluentSchema::make()->type()->array()->minContains(10)->return()->compile())->toBe(['type' => 'array', 'minContains' => 10]);
    });

    test('unevaluatedItems', function() {
        expect(FluentSchema::make()->type()->array()->unevaluatedItems(FluentSchema::make()->type()->number()->return())->return()->compile())->toBe(['type' => 'array', 'unevaluatedItems' => ['type' => 'number']]);
    });

    test('additionalItems', function() {
        expect(FluentSchema::make()->type()->array()->additionalItems([FluentSchema::make()->type()->string(), FluentSchema::make()->type()->number()])->return()->compile())->toBe(['type' => 'array', 'additionalItems' => [['type' => 'string'], ['type' => 'number']]]);
    });

    test('prefixItems', function() {
        expect(FluentSchema::make()->type()->array()->prefixItems([FluentSchema::make()->type()->number()->return()])->return()->compile())->toBe(['type' => 'array', 'prefixItems' => [['type' => 'number']]]);
    });

    test('items', function() {
        expect(FluentSchema::make()->type()->array()->items(FluentSchema::make()->type()->number()->return())->return()->compile())->toBe(['type' => 'array', 'items' => ['type' => 'number']]);
    });

    test('contains', function() {
        expect(FluentSchema::make()->type()->array()->contains(FluentSchema::make()->type()->number()->return())->return()->compile())->toBe(['type' => 'array', 'contains' => ['type' => 'number']]);
    });

});

describe('object builder', function() {

    test('maxProperties', function() {
        expect(FluentSchema::make()->type()->object()->maxProperties(10)->return()->compile())->toBe(['type' => 'object', 'maxProperties' => 10]);
    });

    test('minProperties', function() {
        expect(FluentSchema::make()->type()->object()->minProperties(10)->return()->compile())->toBe(['type' => 'object', 'minProperties' => 10]);
    });

    test('required', function() {
        expect(FluentSchema::make()->type()->object()->requiredProperties(['test1', 'test2'])->return()->compile())->toBe(['type' => 'object', 'required' => ['test1', 'test2']]);
    });

    test('dependentRequired', function() {
        expect(FluentSchema::make()->type()->object()->dependentRequired(['test1' => FluentSchema::make()->type()->number()->return()])->return()->compile())->toBe(['type' => 'object', 'dependentRequired' => ['test1' => ['type' => 'number']]]);
    });

    test('unevaluatedProperties', function() {
        expect(FluentSchema::make()->type()->object()->unevaluatedProperties(FluentSchema::make()->type()->number()->return())->return()->compile())->toBe(['type' => 'object', 'unevaluatedProperties' => ['type' => 'number']]);
    });

    test('additionalProperties', function() {
        expect(FluentSchema::make()->type()->object()->additionalProperties(FluentSchema::make()->type()->number()->return())->return()->compile())->toBe(['type' => 'object', 'additionalProperties' => ['type' => 'number']]);
    });

    test('properties', function() {
        expect(FluentSchema::make()->type()->object()->properties(['number' => FluentSchema::make()->type()->number()->return(), 'string' => FluentSchema::make()->type()->string()->return()])->return()->compile())->toBe(['type' => 'object', 'properties' => ['number' => ['type' => 'number'], 'string' => ['type' => 'string']]]);
    });

    test('property', function() {
        expect(FluentSchema::make()->type()->object()->property('number', FluentSchema::make()->type()->number()->return())->property('string', FluentSchema::make()->type()->string()->return())->return()->compile())->toBe(['type' => 'object', 'properties' => ['number' => ['type' => 'number'], 'string' => ['type' => 'string']]]);
    });

    test('patternProperties', function() {
        expect(FluentSchema::make()->type()->object()->patternProperties(['^[a-z]$' => FluentSchema::make()->type()->number()->return()])->return()->compile())->toBe(['type' => 'object', 'patternProperties' => ['^[a-z]$' => ['type' => 'number']]]);
    });

    test('dependentSchemas', function() {
        expect(FluentSchema::make()->type()->object()->dependentSchemas(['test1' => FluentSchema::make()->type()->number()->return()])->return()->compile())->toBe(['type' => 'object', 'dependentSchemas' => ['test1' => ['type' => 'number']]]);
    });

    test('propertyNames', function() {
        expect(FluentSchema::make()->type()->object()->propertyNames(FluentSchema::make()->type()->number()->return())->return()->compile())->toBe(['type' => 'object', 'propertyNames' => ['type' => 'number']]);
    });

});

test('can require object properties directly', function() {
    expect(FluentSchema::make()->type()->object()->property('test1', FluentSchema::make()->type()->string()->required())->return()->compile())->toBe(['type' => 'object', 'required' => ['test1'], 'properties' => ['test1' => ['type' => 'string']]]);
});

test('array builder restricted values', function(string $method) {
    FluentSchema::make()->type()->array()->$method(-1);
})->with([
    'minContains',
    'maxContains',
])->throws(NonNegativeIntegerException::class);

test('object builder restricted values', function(string $method) {
    FluentSchema::make()->type()->object()->$method(-1);
})->with([
    'maxProperties',
    'minProperties',
])->throws(NonNegativeIntegerException::class);

test('string builder restricted values', function(string $method) {
    FluentSchema::make()->type()->string()->$method(-1);
})->with([
    'maxLength',
    'minLength',
])->throws(NonNegativeIntegerException::class);

test('foreach', function() {
    expect(FluentSchema::make()->type()->object()->foreach(['a', 'b', 'c'], function(ObjectBuilder $fs, string $i) {
        $fs->properties([$i => FluentSchema::make()->type()->number()]);
    })->return()->compile())->toBe([
        'type'       => 'object',
        'properties' => [
            'a' => ['type' => 'number'],
            'b' => ['type' => 'number'],
            'c' => ['type' => 'number'],
        ],
    ]);
});

test('can override key ordering', function() {
    $schema = FluentSchema::make()->schema('schema')->id('id');
    $schema->getSchemaDTO()->setKeyOrder(['$id', '$schema']);
    expect($schema->compile())->toBe(['$id' => 'id', '$schema' => 'schema']);
});

test('proxy __set', function() {
    $schema                         = FluentSchema::make();
    $schema->getSchemaDTO()->schema = 'schema';
    expect($schema->compile())->toBe(['$schema' => 'schema']);
});

describe('builder dto access', function() {
    test('FluentSchemaCore def', function() {
        $schema = FluentSchema::make()->def('test', FluentSchema::make()->type()->object());

        expect($schema->getSchemaDTO()->defs)->toHaveCount(1)->each->toBeInstanceOf(FluentSchema::class);
    });

    test('ObjectBuilder dto access', function(string $function) {
        $schema = FluentSchema::make()->type()->object()->$function(FluentSchema::make()->type()->object())->return();

        expect($schema->getSchemaDTO()->$function)->toBeInstanceOf(FluentSchema::class);
    })->with(['unevaluatedProperties', 'additionalProperties', 'propertyNames']);

    test('ObjectBuilder dto access property', function() {
        $schema = FluentSchema::make()->type()->object()->property('test', FluentSchema::make()->type()->object())->return();

        expect($schema->getSchemaDTO()->properties)->toHaveCount(1)->each->toBeInstanceOf(FluentSchema::class);
    });

    test('ArrayBuilder dto access', function(string $function) {
        $schema = FluentSchema::make()->type()->array()->$function(FluentSchema::make()->type()->object())->return();

        expect($schema->getSchemaDTO()->$function)->toBeInstanceOf(FluentSchema::class);
    })->with(['unevaluatedItems', 'items', 'contains']);

    test('ContentBuilder dto access', function() {
        $schema = FluentSchema::make()->content()->schema(FluentSchema::make()->type()->object())->return();

        expect($schema->getSchemaDTO()->contentSchema)->toBeInstanceOf(FluentSchema::class);
    });

});

test('can return from builders', function(string $builder) {
    $schema = FluentSchema::make()->$builder()->return();

    expect($schema)->toBeInstanceOf(FluentSchema::class);
})->with(['array', 'number', 'object', 'string', 'content', 'format', 'type']);

test('tap', function() {
    $schema = FluentSchema::make()->tap(function(FluentSchema $schema) {
        $schema->id('id');
    });

    expect($schema->compile())->toBe(['$id' => 'id']);
});

test('custom keywords', function() {
    $schema = FluentSchema::make()
        ->id('id')
        ->customKeyword('word1', 'test1')
        ->schema('schema')
        ->customKeyword('word2', 'test2')
        ->customKeyword('word3', 'test3');

    expect($schema->compile())->toBe([
        '$id'     => 'id',
        'word1'   => 'test1',
        '$schema' => 'schema',
        'word2'   => 'test2',
        'word3'   => 'test3',
    ]);
});
