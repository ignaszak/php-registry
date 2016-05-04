# ignaszak/registry

[![Build Status](https://travis-ci.org/ignaszak/php-registry.svg?branch=master)](https://travis-ci.org/ignaszak/php-registry) [![Coverage Status](https://coveralls.io/repos/github/ignaszak/php-registry/badge.svg?branch=master)](https://coveralls.io/github/ignaszak/php-registry?branch=master)

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
phpunit
```

## Requirments

php >= 7.0

## Example

```php
use Ignaszak\Registry\Conf;
use Ignaszak\Registry\RegistryFactory;

include __DIR__ . '/autoload.php';

// Configuration - optional
// Conf::setTmpPath(string $tmpPath);      // default: './src/tmp'
// Conf::setCookieLife(int $cookieLife);   // default: 30 days
// Conf::setCookiePath(string $cookiePath) // default: '/'

// Use start method to begin
// RegistryFactory::start([string $registry = 'request']):
//      'request' - stores objects in variable - DEFAULT OPTION
//      'session' - stores objects in session
//      'cookie'  - stores objects in cookie
//      'file'    - stores objects in files
$registry = RegistryFactory::start();

// Use set and get methods
// The first parameter is a key at witch created object is stored
// Key is used in any other method
$registry->set('key', new AnyClass);
$registry->get('key'); // Returns AnyClass instance

// Returns true if the key is defined
$registry->has('key');

// Reload object
$registry->reload('key');

// Removes from register
$registry->remove('key');

// Use register method
// First use sets and returns instance of Namespace\AnyClass
// Any further use only returns instance of Namespace\AnyClass
$registry->register('Namespace\AnyClass');
// It is possible to use has, reload and remove methods
$registry->has('Namespace\AnyClass');
$registry->reload('Namespace\AnyClass');
$registry->remove('Namespace\AnyClass');
```
