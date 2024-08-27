<?php

/** @noinspection MultipleExpectChainableInspection */

use FluentJsonSchema\Exceptions\FluentSchemaException;
use FluentJsonSchema\FluentSchema;

test('set storage', function() {
    $storage = new \JsonSchema\SchemaStorage;
    expect(FluentSchema::make()->setSchemaStorage($storage)->getSchemaStorage())->toBe($storage);
});

test('get storage', function() {
    expect(FluentSchema::make()->getSchemaStorage())->toBeInstanceOf(\JsonSchema\SchemaStorage::class);
});

test('validate', function() {
    $schema = FluentSchema::make()
        ->type()->object()->type()->boolean()
        ->object()
        ->additionalProperties(FluentSchema::make()->false())
        ->property('property1', FluentSchema::make()->type()->string())
        ->property('property2', FluentSchema::make()->type()->string())
        ->return();

    $data = (object)[
        'property1' => 'test1',
        'property2' => 'test2',
    ];

    $validator = $schema->validate($data);

    expect($validator->isValid())->toBeTrue();
});

test('validate with flags', function() {
    $schema = FluentSchema::make()
        ->type()->object()->type()->boolean()
        ->object()
        ->additionalProperties(FluentSchema::make()->false())
        ->property('property1', FluentSchema::make()->type()->boolean())
        ->return();

    $data = (object)[
        'property1' => 'true',
    ];

    $validator = $schema->validate($data, \JsonSchema\Constraints\Constraint::CHECK_MODE_COERCE_TYPES);

    expect($validator->isValid())->toBeTrue();

    expect($data)->toEqual((object)['property1' => true], 'string value should be coerced to boolean');
});

test('add additional validation schema', function() {
    $nestedSchema = FluentSchema::make()
        ->id('file://nested')
        ->type()->object()
        ->additionalProperties(FluentSchema::make()->false())
        ->property('property2', FluentSchema::make()->type()->boolean())
        ->return();

    $schema = FluentSchema::make()
        ->type()->object()->type()->boolean()
        ->object()
        ->additionalProperties(FluentSchema::make()->false())
        ->property('property1', FluentSchema::make()->type()->string())
        ->property('nested', FluentSchema::make()->ref('file://nested'))
        ->return();

    $data = (object)[
        'property1' => 'value1',
        'nested'    => (object)[
            'property2' => 'value3',
        ],
    ];

    $schema->addValidationSchema($nestedSchema);

    $validator = $schema->validate($data, \JsonSchema\Constraints\Constraint::CHECK_MODE_COERCE_TYPES);

    expect($validator->isValid())->toBeFalse();

    expect($validator->getErrors())->toBe([[
        'property'   => 'nested.property2',
        'pointer'    => '/nested/property2',
        'message'    => 'String value found, but a boolean is required',
        'constraint' => 'type',
        'context'    => 1,
    ]]);
});

test('additional validation schema requires id', function() {
    $schema = FluentSchema::make()
        ->type()->object()
        ->additionalProperties(FluentSchema::make()->false())
        ->property('property2', FluentSchema::make()->type()->boolean())
        ->return();

    FluentSchema::make()->addValidationSchema($schema);

})->expectExceptionObject(new FluentSchemaException('Schema id was not provided'));
