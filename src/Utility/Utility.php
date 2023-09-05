<?php

namespace FluentJsonSchema\Utility;

define('ARRAY_ORDER_KEYS_MISSING_NEVER', 0);
define('ARRAY_ORDER_KEYS_MISSING_FIRST', 1);
define('ARRAY_ORDER_KEYS_MISSING_LAST', 2);

function array_order_keys(array $data, array $keyOrder, int $flags = ARRAY_ORDER_KEYS_MISSING_LAST): array
{
    $result = [];

    $bothFlags = ARRAY_ORDER_KEYS_MISSING_FIRST | ARRAY_ORDER_KEYS_MISSING_LAST;

    if (($flags & $bothFlags) === $bothFlags) {
        throw new \InvalidArgumentException("Flags 'ARRAY_ORDER_KEYS_MISSING_FIRST' and 'ARRAY_ORDER_KEYS_MISSING_LAST' cannot both be specified.");
    }

    if ($flags & ARRAY_ORDER_KEYS_MISSING_FIRST || $flags & ARRAY_ORDER_KEYS_MISSING_LAST) {
        foreach ($data as $key => $value) {
            if (!in_array($key, $keyOrder)) {
                if ($flags & ARRAY_ORDER_KEYS_MISSING_FIRST) {
                    $keyOrder = [$key, ...$keyOrder];
                } elseif ($flags & ARRAY_ORDER_KEYS_MISSING_LAST) {
                    $keyOrder[] = $key;
                }
            }
        }
    }

    foreach ($keyOrder as $key) {
        if (array_key_exists($key, $data)) {
            $result[$key] = $data[$key];
        }
    }

    return $result;
}
