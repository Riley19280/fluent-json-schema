# fluent-json-schema
Create json schema with ease

## Installation 

```
composer require riley19280/fluent-json-schema
```


## Basic Usage

```php
use FluentJsonSchema\FluentSchema;

$schema = FluentSchema::make()
    ->type()->object()
    ->property('name', FluentSchema::make()
        ->type()->string()
    )
    ->return()
    ->compile();
/* Results in
{
    "type": "object",
    "properties": {
        "name": {
            "type": "string"
        }
    }
}
*/
```

More advanced usage can be found [here](https://github.com/Riley19280/fluent-json-schema/blob/master/tests/Unit/EndToEndTest.php).
The entire meta-schema spec has been implemented using this package.

### Contexts

There are several different "contexts" that you can be in while constructing json schema objects. 
These are the main data type contexts 

- array
- integer
- number
- object
- string
                                                                                                 
Each of them have different methods that set specific properties related to that data type.
If at any time you need to return to the "global" context, you can call the `return` method. 

### Boolean Schemas

In some cases, a schema that evaluates to `true` or `false` is needed, you can pass
`FluentSchema::make()->true()` or `FluentSchema::make()->false()`

```php
FluentSchema::make()
    ->type()->object()
    ->additionalProperties(FluentSchema::make()->false())
```

### Converting to JSON

When done constructing your schema object, call the `compile` method on it. 
This will return a php array that you can then serialize to json.

By default, properties will be serialized in the order they are added to an object, i.e.
                                         
```php
$schema = FluentSchema::make()->schema('schema')->id('id')->compile();
// Will be
// { "$schema": "schema", "$id": "id" }
$schema = FluentSchema::make()->id('id')->schema('schema')->compile();
// Will be
// { "$id": "id", "$schema": "schema" }
```

This can be changed by calling `$schema->getSchemaDTO()->setKeyOrder(['$id', '$schema'])`.
This will override the serialization order. Any unlisted keys will be added to the end.

## Validation

Validation is done using the [justinrainbow/json-schema](https://github.com/justinrainbow/json-schema) package.

The following methods are available on the `FluentSchema` object to aid in schema validation:

- `getSchemaStorage(): SchemaStorage` 
- `setSchemaStorage(SchemaStorage $schemaStorage): static` 
- `validate(mixed &$data, int $checkMode = null): Validator` 
- `addValidationSchema(object|array $schema, string $id = null): static`

```php
$isValid = FluentSchema::make()
    ->type()->object()
    ->property('name', FluentSchema::make()
        ->type()->string()
    )
    ->return()
    ->validate((object)[
        'name' => 'validated!',
    ])
    ->isValid();
```

Please see the package documentation [justinrainbow/json-schema](https://github.com/justinrainbow/json-schema) for more detailed information on validation.
