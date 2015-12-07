<?php

include __DIR__ . '/autoload.php';

// Use start method to begin
// RegistryFactory::start([string $registry = 'request']):
//      'request' - stores objects in variable - DEFAULT OPTION
//      'session' - stores objects in session
//      'cookie'  - stores objects in cookie
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
echo TestClass::$counter;    // Will output 1
$registry->get('test');
echo TestClass::$counter;    // Will output 1

// Reload object
$registry->reload('test');
echo TestClass::$counter;    // Will output 2

// Remove from register
$registry->remove('test');

// Use register method
$registry->register('TestClass'); // First use sets instance of TestClass
echo TestClass::$counter; // Will output 3
$registry->register('TestClass'); // Returns TestClass object
echo TestClass::$counter; // Will output 3
$registry->reload('TestClass');
echo TestClass::$counter; // Will output 4
$registry->get('TestClass'); // Returns TestClass object
$registry->remove('TestClass');

?>