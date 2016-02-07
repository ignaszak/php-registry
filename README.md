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
$registry->set('test', new AnyClass);
$registry->get('test'); // Returns AnyClass instance

// Reload object
$registry->reload('test');

// Remove from register
$registry->remove('test');

// Use register method
// First use sets and returns instance of AnyClass
// Any further use only returns instance of AnyClass
$registry->register('AnyClass');
```
