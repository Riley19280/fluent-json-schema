<?php

use FluentJsonSchema\Concerns\FluentSchemaDTOAccessor;

test('will not use debugging functions', function() {
    expect(['dd', 'dump', 'ray'])
        ->each->not->toBeUsed();
});

test('will not pollute RFC classes', function() {
    expect('FluentJsonSchema\RFC')
        ->not->toUse(FluentSchemaDTOAccessor::class);
});
