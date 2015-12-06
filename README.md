# ignaszak/registry

Registry pattern

## Installing

The package is avilable via [Composer/Packagist](https://packagist.org/packages/ignaszak/registry), so just add following lines to your composer.json file:

```json
"require" : {
    "ignaszak/registry" : "*"
}
```

or:

```sh
composer require ignaszak/registry
```

## Running Tests

Just run phpunit from the working directory

```sh
php phpunit.phar
```

## Requirments

php >= 7.0

## Example

```php
// Use start method to begin
// RegistryFactory::start([string $registry = 'request']):
//      'request' - stores objects in variable - DEFAULT OPTION
//      'session' - stores objects in session  - NOT COMPLETED
//      'coockie' - stores objects in coockie  - NOT COMPLETED
$registry = Ignaszak\Registry\RegistryFactory::start();

// Test class
class TestClass
{
    public static $counter = 0;

    public function __construct()
    {
        ++ self::$counter;
    }
}

// Use set and get methods
$registry->set('test', new TestClass);
$registry->get('test');
echo Test::$counter;    // Will output 1
$registry->get('test');
echo Test::$counter;    // Will output 1

// Reload object
$registry->reload('test');
echo Test::$counter;    // Will output 2

// Remove from register
$registry->remove('test');

// Use register method
$registry->register('TestClass'); // First use sets instance of TestClass
echo Test::$counter; // Will output 3
$registry->register('TestClass'); // Returns TestClass object
echo Test::$counter; // Will output 3
$registry->reload('TestClass');
echo Test::$counter; // Will output 4
$registry->get('TestClass'); // Returns TestClass object
$registry->remove('TestClass');
```