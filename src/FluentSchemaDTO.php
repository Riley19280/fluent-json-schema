<?php

namespace FluentJsonSchema;

use FluentJsonSchema\Builders\Types\AbstractTypeBuilder;
use FluentJsonSchema\Enums\JsonSchemaType;
use FluentJsonSchema\RFC\ApplicatorSchema;
use FluentJsonSchema\RFC\ContentSchema;
use FluentJsonSchema\RFC\CoreSchema;
use FluentJsonSchema\RFC\FormatSchema;
use FluentJsonSchema\RFC\MetadataSchema;
use FluentJsonSchema\RFC\MiscSchema;
use FluentJsonSchema\RFC\UnevaluatedSchema;
use FluentJsonSchema\RFC\ValidationSchema;
use FluentJsonSchema\Utility\FluentSchemaDTOProxy;
use FluentJsonSchema\Utility\UnserializedAttribute;
use FluentJsonSchema\Utility\UtilityContainer;

use function FluentJsonSchema\Utility\array_order_keys;

class FluentSchemaDTO
{
    use ApplicatorSchema;
    use ContentSchema;
    use CoreSchema;
    use FormatSchema;
    use MetadataSchema;
    use MiscSchema;
    use UnevaluatedSchema;
    use ValidationSchema;
    use UtilityContainer;

    /**
     * @var array<string, mixed>
     */
    #[UnserializedAttribute]
    private array $customKeywords = [];

    #[UnserializedAttribute]
    private ?array $keyOrder;
    #[UnserializedAttribute]
    private FluentSchemaDTOProxy $proxy;

    #[UnserializedAttribute]
    private array $utilityContainer = [];

    public function setProxy(FluentSchemaDTOProxy $proxy): static
    {
        $this->proxy = $proxy;

        return $this;
    }

    /**
     * Set the order in which the json schema properties should be ordered.
     *
     * @param array $keyOrder
     *
     * @return $this
     */
    public function setKeyOrder(array $keyOrder): static
    {
        $this->keyOrder = $keyOrder;

        return $this;
    }

    public function customKeyword(string $keyword, mixed $value): static
    {
        $this->customKeywords[$keyword] = $value;

        return $this;
    }

    public function toArray(): array
    {
        $data = array_filter(get_object_vars($this), function($v) {
            return $v !== null;
        });

        $unserializedKeys = array_filter((new \ReflectionClass($this))->getProperties(), function(\ReflectionProperty $property) {
            $attrs = $property->getAttributes(UnserializedAttribute::class);

            return count($attrs) > 0;
        });

        foreach ($unserializedKeys as $key) {
            unset($data[$key->getName()]);
        }

        $type = $this->getTypeForArray($data);

        $data = [
            ...$data,
            ...($type ? ['type' => $type] : []),
            ...$this->customKeywords,
        ];

        foreach ($this->getPrefixedProperties() as $key => $prefix) {
            if (array_key_exists($key, $data)) {
                $data["$prefix$key"] = $data[$key];
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

        if (!isset($this->keyOrder)) {
            $this->keyOrder = [];
            foreach ($this->proxy->propertySets as $setCalled) {
                if (!in_array($setCalled, $this->keyOrder)) {
                    if (array_key_exists($setCalled, $this->getPrefixedProperties())) {
                        $setCalled = $this->getPrefixedProperties()[$setCalled] . $setCalled;
                    }
                    $this->keyOrder[] = $setCalled;
                }
            }
        }

        $sortedData = array_order_keys($data, $this->keyOrder);

        return $sortedData;
    }

    /**
     * Map the array of enum types to their string equivalents.
     * If there is only one type on the object, then a string will be returned.
     *
     * @param array $data
     *
     * @return null|string|array
     */
    protected function getTypeForArray(array $data): string|array|null
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

    protected function getPrefixedProperties(): array
    {
        return [
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
    }
}
