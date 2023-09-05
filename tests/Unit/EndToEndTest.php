<?php

use FluentJsonSchema\FluentSchema;

test('e2e Core and Validation specifications meta-schema', function() {
    //    $file = __DIR__ . '/../../references/_meta.json';
    //    $schema = json_decode(file_get_contents($file), true);
    //    expect($schema)->toMatchSnapshot();

    $schema = FluentSchema::make()
        ->schema('https://json-schema.org/draft/2020-12/schema')
        ->id('https://json-schema.org/draft/2020-12/schema')
        ->vocabulary([
            'https://json-schema.org/draft/2020-12/vocab/core'              => true,
            'https://json-schema.org/draft/2020-12/vocab/applicator'        => true,
            'https://json-schema.org/draft/2020-12/vocab/unevaluated'       => true,
            'https://json-schema.org/draft/2020-12/vocab/validation'        => true,
            'https://json-schema.org/draft/2020-12/vocab/meta-data'         => true,
            'https://json-schema.org/draft/2020-12/vocab/format-annotation' => true,
            'https://json-schema.org/draft/2020-12/vocab/content'           => true,
        ])
        ->dynamicAnchor('meta')
        ->title('Core and Validation specifications meta-schema')
        ->allOf([
            FluentSchema::make()->ref('meta/core'),
            FluentSchema::make()->ref('meta/applicator'),
            FluentSchema::make()->ref('meta/unevaluated'),
            FluentSchema::make()->ref('meta/validation'),
            FluentSchema::make()->ref('meta/meta-data'),
            FluentSchema::make()->ref('meta/format-annotation'),
            FluentSchema::make()->ref('meta/content'),
        ])
        ->type()->object()->type()->boolean()
        ->comment('This meta-schema also defines keywords that have appeared in previous drafts in order to prevent incompatible extensions as they remain in common use.')
        ->object()
        ->property('definitions', FluentSchema::make()
            ->comment('"definitions" has been replaced by "$defs".')
            ->type()->object()
            ->additionalProperties(FluentSchema::make()->dynamicRef('#meta'))
            ->return()
            ->deprecated()
            ->default([])
        )
        ->property('dependencies', FluentSchema::make()
            ->comment('"dependencies" has been split and replaced by "dependentSchemas" and "dependentRequired" in order to serve their differing semantics.')
            ->type()->object()
            ->additionalProperties(FluentSchema::make()
                ->anyOf([
                    FluentSchema::make()->dynamicRef('#meta'),
                    FluentSchema::make()->ref('meta/validation#/$defs/stringArray'),
                ])
            )
            ->return()
            ->deprecated()
            ->default([])
        )
        ->property('$recursiveAnchor', FluentSchema::make()
            ->comment('"$recursiveAnchor" has been replaced by "$dynamicAnchor".')
            ->ref('meta/core#/$defs/anchorString')
            ->deprecated()
        )
        ->property('$recursiveRef', FluentSchema::make()
            ->comment('"$recursiveRef" has been replaced by "$dynamicRef".')
            ->ref('meta/core#/$defs/uriReferenceString')
            ->deprecated()
        )
        ->return();

    expect($schema->compile())->toMatchSnapshot();
});

test('e2e Applicator vocabulary meta-schema', function() {
    //    $file   = __DIR__ . '/../../references/applicator.json';
    //    $schema = json_decode(file_get_contents($file), true);
    //    expect($schema)->toMatchSnapshot();

    $schema = FluentSchema::make()
        ->schema('https://json-schema.org/draft/2020-12/schema')
        ->id('https://json-schema.org/draft/2020-12/meta/applicator')
        ->vocabulary([
            'https://json-schema.org/draft/2020-12/vocab/applicator' => true,
        ])
        ->dynamicAnchor('meta')
        ->title('Applicator vocabulary meta-schema')
        ->type()->object()->type()->boolean()
        ->object()
        ->property('prefixItems', FluentSchema::make()
            ->ref('#/$defs/schemaArray')
        )
        ->property('items', FluentSchema::make()
            ->dynamicRef('#meta')
        )
        ->property('contains', FluentSchema::make()
            ->dynamicRef('#meta')
        )
        ->property('additionalProperties', FluentSchema::make()
            ->dynamicRef('#meta')
        )
        ->property('properties', FluentSchema::make()
            ->type()->object()
            ->additionalProperties(FluentSchema::make()->dynamicRef('#meta'))
            ->return()
            ->default([])
        )
        ->property('patternProperties', FluentSchema::make()
            ->type()->object()
            ->additionalProperties(FluentSchema::make()->dynamicRef('#meta'))
            ->propertyNames(FluentSchema::make()->format()->regex())
            ->return()
            ->default([])
        )
        ->property('dependentSchemas', FluentSchema::make()
            ->type()->object()
            ->additionalProperties(FluentSchema::make()->dynamicRef('#meta'))
            ->return()
            ->default([])
        )
        ->property('propertyNames', FluentSchema::make()
            ->dynamicRef('#meta')
        )
        ->property('if', FluentSchema::make()
            ->dynamicRef('#meta')
        )
        ->property('then', FluentSchema::make()
            ->dynamicRef('#meta')
        )
        ->property('else', FluentSchema::make()
            ->dynamicRef('#meta')
        )
        ->property('allOf', FluentSchema::make()
            ->ref('#/$defs/schemaArray')
        )
        ->property('anyOf', FluentSchema::make()
            ->ref('#/$defs/schemaArray')
        )
        ->property('oneOf', FluentSchema::make()
            ->ref('#/$defs/schemaArray')
        )
        ->property('not', FluentSchema::make()
            ->dynamicRef('#meta')
        )
        ->return()
        ->defs([
            'schemaArray' => FluentSchema::make()->type()->array()->minItems(1)->items(FluentSchema::make()->dynamicRef('#meta')),
        ]);

    expect($schema->compile())->toMatchSnapshot();
});

test('e2e Content vocabulary meta-schema', function() {
    //    $file   = __DIR__ . '/../../references/content.json';
    //    $schema = json_decode(file_get_contents($file), true);
    //    expect($schema)->toMatchSnapshot();

    $schema = FluentSchema::make()
        ->schema('https://json-schema.org/draft/2020-12/schema')
        ->id('https://json-schema.org/draft/2020-12/meta/content')
        ->vocabulary([
            'https://json-schema.org/draft/2020-12/vocab/content' => true,
        ])
        ->dynamicAnchor('meta')
        ->title('Content vocabulary meta-schema')
        ->type()->object()->type()->boolean()
        ->object()
        ->property('contentEncoding', FluentSchema::make()->type()->string())
        ->property('contentMediaType', FluentSchema::make()->type()->string())
        ->property('contentSchema', FluentSchema::make()->dynamicRef('#meta'))
        ->return();

    expect($schema->compile())->toMatchSnapshot();
});

test('e2e Core vocabulary meta-schema', function() {
    //    $file   = __DIR__ . '/../../references/core.json';
    //    $schema = json_decode(file_get_contents($file), true);
    //    expect($schema)->toMatchSnapshot();

    $schema = FluentSchema::make()
        ->schema('https://json-schema.org/draft/2020-12/schema')
        ->id('https://json-schema.org/draft/2020-12/meta/core')
        ->vocabulary([
            'https://json-schema.org/draft/2020-12/vocab/core' => true,
        ])
        ->dynamicAnchor('meta')
        ->title('Core vocabulary meta-schema')
        ->type()->object()->type()->boolean()
        ->object()
        ->property('$id', FluentSchema::make()
            ->ref('#/$defs/uriReferenceString')
            ->comment('Non-empty fragments not allowed.')
            ->string()->pattern('^[^#]*#?$')
        )
        ->property('$schema', FluentSchema::make()
            ->ref('#/$defs/uriString')
        )
        ->property('$ref', FluentSchema::make()
            ->ref('#/$defs/uriReferenceString')
        )
        ->property('$anchor', FluentSchema::make()
            ->ref('#/$defs/anchorString')
        )
        ->property('$dynamicRef', FluentSchema::make()
            ->ref('#/$defs/uriReferenceString')
        )
        ->property('$dynamicAnchor', FluentSchema::make()
            ->ref('#/$defs/anchorString')
        )
        ->property('$vocabulary', FluentSchema::make()
            ->type()->object()
            ->propertyNames(FluentSchema::make()->ref('#/$defs/uriString'))
            ->additionalProperties(FluentSchema::make()->type()->boolean())
        )
        ->property('$comment', FluentSchema::make()
            ->type()->string()
        )
        ->property('$defs', FluentSchema::make()
            ->type()->object()
            ->additionalProperties(FluentSchema::make()->dynamicRef('#meta'))
            ->return()
        )
        ->return()
        ->def('anchorString', FluentSchema::make()
            ->type()->string()
            ->pattern('^[A-Za-z_][-A-Za-z0-9._]*$')
        )
        ->def('uriString', FluentSchema::make()
            ->type()->string()->format()->uri()
        )
        ->def('uriReferenceString', FluentSchema::make()
            ->type()->string()->format()->uriReference()
        );

    expect($schema->compile())->toMatchSnapshot();
});

test('e2e Format vocabulary meta-schema for annotation results', function() {
    //    $file   = __DIR__ . '/../../references/format.json';
    //    $schema = json_decode(file_get_contents($file), true);
    //    expect($schema)->toMatchSnapshot();

    $schema = FluentSchema::make()
        ->schema('https://json-schema.org/draft/2020-12/schema')
        ->id('https://json-schema.org/draft/2020-12/meta/format-annotation')
        ->vocabulary([
            'https://json-schema.org/draft/2020-12/vocab/format-annotation' => true,
        ])
        ->dynamicAnchor('meta')
        ->title('Format vocabulary meta-schema for annotation results')
        ->type()->object()->type()->boolean()
        ->object()
        ->property('format', FluentSchema::make()->type()->string())
        ->return();

    expect($schema->compile())->toMatchSnapshot();
});

test('e2e Meta-data vocabulary meta-schema', function() {
    //    $file = __DIR__ . '/../../references/medatadata.json';
    //    $schema = json_decode(file_get_contents($file), true);
    //    expect($schema)->toMatchSnapshot();

    $schema = FluentSchema::make()
        ->schema('https://json-schema.org/draft/2020-12/schema')
        ->id('https://json-schema.org/draft/2020-12/meta/meta-data')
        ->vocabulary([
            'https://json-schema.org/draft/2020-12/vocab/meta-data' => true,
        ])
        ->dynamicAnchor('meta')
        ->title('Meta-data vocabulary meta-schema')
        ->type()->object()
        ->type()->boolean()
        ->object()
        ->property('title', FluentSchema::make()
            ->type()->string()
        )
        ->property('description', FluentSchema::make()
            ->type()->string()
        )
        ->property('default', FluentSchema::make()->true())
        ->property('deprecated', FluentSchema::make()
            ->type()->boolean()->default(false)
        )
        ->property('readOnly', FluentSchema::make()
            ->type()->boolean()->default(false)
        )
        ->property('writeOnly', FluentSchema::make()
            ->type()->boolean()->default(false)
        )
        ->property('examples', FluentSchema::make()
            ->type()->array()->items(FluentSchema::make()->true())
        )
        ->return();

    expect($schema->compile())->toMatchSnapshot();
});

test('e2e Unevaluated applicator vocabulary meta-schema', function() {
    //    $file   = __DIR__ . '/../../references/unevaluated.json';
    //    $schema = json_decode(file_get_contents($file), true);
    //    expect($schema)->toMatchSnapshot();

    $schema = FluentSchema::make()
        ->schema('https://json-schema.org/draft/2020-12/schema')
        ->id('https://json-schema.org/draft/2020-12/meta/unevaluated')
        ->vocabulary([
            'https://json-schema.org/draft/2020-12/vocab/unevaluated' => true,
        ])
        ->dynamicAnchor('meta')
        ->title('Unevaluated applicator vocabulary meta-schema')
        ->type()->object()->type()->boolean()
        ->object()
        ->property('unevaluatedItems', FluentSchema::make()->dynamicRef('#meta'))
        ->property('unevaluatedProperties', FluentSchema::make()->dynamicRef('#meta'))
        ->return();

    expect($schema->compile())->toMatchSnapshot();
});

test('e2e Validation vocabulary meta-schema', function() {
    //    $file   = __DIR__ . '/../../references/validation.json';
    //    $schema = json_decode(file_get_contents($file), true);
    //    expect($schema)->toMatchSnapshot();

    $schema = FluentSchema::make()
        ->schema('https://json-schema.org/draft/2020-12/schema')
        ->id('https://json-schema.org/draft/2020-12/meta/validation')
        ->vocabulary([
            'https://json-schema.org/draft/2020-12/vocab/validation' => true,
        ])
        ->dynamicAnchor('meta')
        ->title('Validation vocabulary meta-schema')
        ->type()->object()->type()->boolean()
        ->object()
        ->property('type', FluentSchema::make()
            ->anyOf([
                FluentSchema::make()->ref('#/$defs/simpleTypes'),
                FluentSchema::make()->type()->array()
                    ->items(FluentSchema::make()->ref('#/$defs/simpleTypes'))
                    ->minItems(1)
                    ->uniqueItems(),
            ])
        )
        ->property('const', FluentSchema::make()
            ->true()
        )
        ->property('enum', FluentSchema::make()
            ->type()->array()
            ->items(FluentSchema::make()->true())
        )
        ->property('multipleOf', FluentSchema::make()
            ->type()->number()
            ->exclusiveMinimum(0)
        )
        ->property('maximum', FluentSchema::make()
            ->type()->number()
        )
        ->property('exclusiveMaximum', FluentSchema::make()
            ->type()->number()
        )
        ->property('minimum', FluentSchema::make()
            ->type()->number()
        )
        ->property('exclusiveMinimum', FluentSchema::make()
            ->type()->number()
        )
        ->property('maxLength', FluentSchema::make()
            ->ref('#/$defs/nonNegativeInteger')
        )
        ->property('minLength', FluentSchema::make()
            ->ref('#/$defs/nonNegativeIntegerDefault0')
        )
        ->property('pattern', FluentSchema::make()
            ->type()->string()
            ->format()->regex()
        )
        ->property('maxItems', FluentSchema::make()
            ->ref('#/$defs/nonNegativeInteger')
        )
        ->property('minItems', FluentSchema::make()
            ->ref('#/$defs/nonNegativeIntegerDefault0')
        )
        ->property('uniqueItems', FluentSchema::make()
            ->type()->boolean()
            ->default(false)
        )
        ->property('maxContains', FluentSchema::make()
            ->ref('#/$defs/nonNegativeInteger')
        )
        ->property('minContains', FluentSchema::make()
            ->ref('#/$defs/nonNegativeInteger')
            ->default(1)
        )
        ->property('maxProperties', FluentSchema::make()
            ->ref('#/$defs/nonNegativeInteger')
        )
        ->property('minProperties', FluentSchema::make()
            ->ref('#/$defs/nonNegativeIntegerDefault0')
        )
        ->property('required', FluentSchema::make()
            ->ref('#/$defs/stringArray')
        )
        ->property('dependentRequired', FluentSchema::make()
            ->type()->object()
            ->additionalProperties(FluentSchema::make()->ref('#/$defs/stringArray'))
        )
        ->return()
        ->def('nonNegativeInteger', FluentSchema::make()
            ->type()->integer()
            ->minimum(0)
        )
        ->def('nonNegativeIntegerDefault0', FluentSchema::make()
            ->ref('#/$defs/nonNegativeInteger')
            ->default(0)
        )
        ->def('simpleTypes', FluentSchema::make()
            ->array()->enum([
                'array',
                'boolean',
                'integer',
                'null',
                'number',
                'object',
                'string',
            ])
        )
        ->def('stringArray', FluentSchema::make()
            ->type()->array()
            ->items(FluentSchema::make()->type()->string())
            ->uniqueItems()
            ->return()
            ->default([])
        );

    expect($schema->compile())->toMatchSnapshot();
});
