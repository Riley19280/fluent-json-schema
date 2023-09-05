<?php

use function FluentJsonSchema\Utility\array_order_keys;

test('array_order_keys never', function() {
    expect(array_order_keys(['key1' => '1', 'key2' => 2, 'unknown' => 'unknown'], ['key2', 'key1'], ARRAY_ORDER_KEYS_MISSING_NEVER))
        ->toBe(['key2' => 2, 'key1' => '1']);
});

test('array_order_keys first', function() {
    expect(array_order_keys(['key1' => '1', 'key2' => 2, 'unknown' => 'unknown'], ['key2', 'key1'], ARRAY_ORDER_KEYS_MISSING_FIRST))
        ->toBe(['unknown' => 'unknown', 'key2' => 2, 'key1' => '1']);
});

test('array_order_keys last', function() {
    expect(array_order_keys(['key1' => '1', 'key2' => 2, 'unknown' => 'unknown'], ['key2', 'key1'], ARRAY_ORDER_KEYS_MISSING_LAST))
        ->toBe(['key2' => 2, 'key1' => '1', 'unknown' => 'unknown']);
});

test('array_order_keys first and last', function() {
    array_order_keys(['key1' => '1'], ['key1'], ARRAY_ORDER_KEYS_MISSING_FIRST | ARRAY_ORDER_KEYS_MISSING_LAST);
})->throws(InvalidArgumentException::class, "Flags 'ARRAY_ORDER_KEYS_MISSING_FIRST' and 'ARRAY_ORDER_KEYS_MISSING_LAST' cannot both be specified.");
