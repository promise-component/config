# Promise Component Config

> Manage Promise configuration by persistent storage.

## Installing

```
composer require promise/component-config
```

## Useing

```php

$config = Promise\Component\Config\Repository

// Set initial configuration items
$config->setItems([
	'foo' => 'Foo',
	'bar' => 'Bar',
]);

// Add a namespace to configuration.
$config->addNamespace(__DIR__ '/your-path/foo', 'user');

// Get a config item.
$config->get('foo');

// Get a namespace config item.
$config->get('user::foo.bar');
```

## Api

| Method | Parameters | Description |
| :-----:| :--------: | :---------: |
| setItems | [array] items | Set the configuration items. |
| has | [string] key | Determine if the given configuration value exists. |
| get | [string] key, [mixed] default | Get the specified configuration value. |
| getMany | [array] keys | Get many configuration values. |
| set | [string] key, [string or array] value | Set a given configuration value. |
| all |   | Get all of the configuration items for the application.. |
