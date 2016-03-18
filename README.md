# ignaszak/registry

[![Build Status](https://travis-ci.org/ignaszak/php-registry.svg?branch=master)](https://travis-ci.org/ignaszak/php-registry)[![Coverage Status](https://coveralls.io/repos/github/ignaszak/php-registry/badge.svg?branch=master)](https://coveralls.io/github/ignaszak/php-registry?branch=master)

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
php composer.phar require ignaszak/registry
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

// Reload object
$registry->reload('key');

// Remove from register
$registry->remove('key');

// Use register method
// In these method key is class name with namespace
// First use sets and returns instance of AnyClass
// Any further use only returns instance of AnyClass
$registry->register('AnyClass');
// It is possible to use earlier methods
$registry->reload('AnyClass');
$registry->remove('AnyClass');


```
