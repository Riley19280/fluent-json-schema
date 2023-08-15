<?php

namespace FluentJsonSchema;

use FluentJsonSchema\Builders\Types\AbstractTypeBuilder;
use FluentJsonSchema\Enums\JsonSchemaType;
use FluentJsonSchema\RFC\ApplicatorSchema;
use FluentJsonSchema\RFC\ContentSchema;
use FluentJsonSchema\RFC\CoreSchema;
use FluentJsonSchema\RFC\FormatSchema;
use FluentJsonSchema\RFC\MetadataSchema;
use FluentJsonSchema\RFC\UnevaluatedSchema;
use FluentJsonSchema\RFC\ValidationSchema;

class FluentSchemaDTO
{
    use ApplicatorSchema;
    use ContentSchema;
    use CoreSchema;
    use FormatSchema;
    use MetadataSchema;
    use UnevaluatedSchema;
    use ValidationSchema;

    const propertyPrefixes = [
        'id'            => '$',
        'schema'        => '$',
        'ref'           => '$',
        'anchor'        => '$',
        'dynamicRef'    => '$',
        'dynamicAnchor' => '$',
        'vocabulary'    => '$',
        'comment'       => '$',
        'defs'          => '$',
    ];

    public function toArray(): array
    {
        $data = array_filter(get_object_vars($this), function($v) {
            return $v !== null;
        });

        $type = $this->getTypeForArray($data);

        $data = [
            ...$data,
            ...($type ? ['type' => $type] : []),
        ];

        foreach (static::propertyPrefixes as $key => $prefix) {
            if (array_key_exists($key, $data)) {
                $data["$$key"] = $data[$key];
                unset($data[$key]);
            }
        }

        array_walk_recursive(
            $data,
            function(&$value) {
                if ($value instanceof FluentSchema) {
                    $value = $value->compile();
                }

                if ($value instanceof AbstractTypeBuilder) {
                    $value = $value->return()->compile();
                }
            }
        );

        return $data;
    }

    /**
     * @param array $data
     *
     * @return null|string|array
     */
    public function getTypeForArray(array $data): string|array|null
    {
        if (!array_key_exists('type', $data)) {
            return null;
        }

        $types = array_map(fn(JsonSchemaType $t) => $t->value, $data['type']);

        if (count($types) === 1) {
            return $types[0];
        }

        return $types;
    }
}
