<?php

namespace SeebeezPHP\Tests;

use ReflectionClass;
use ReflectionMethod;
use ReflectionProperty;
use ReflectionException;
use PHPUnit\Framework\TestCase;

/**
 * Helper class for Test Classes.
 * 
 * @category Test
 * @package  SeebeezPHP
 * @author   Kazi Lotus <kazilotus@hotmail.com>
 * @license  https://www.apache.org/licenses/LICENSE-2.0.txt Apache-2.0
 * @version  Release: @1.0@
 * @link     https://seebeez.com
 */
class Helper extends TestCase
{

    const MOCK_API = "https://service.seebeez.com/mock";

    /**
     * Get Private Property
     *
     * @param string $class    Name of the class
     * @param string $property Name of the property
     *
     * @return ReflectionProperty
     * @throws ReflectionException
     */
    protected function getPrivateProperty($class, $property)
    {
        $reflector = new ReflectionClass($class);
        $property = $reflector->getProperty($property);
        $property->setAccessible(true);

        return $property;
    }

    /**
     * Get Private Method
     *
     * @param string $class  Name of the class
     * @param string $method Name of the Method
     *
     * @return ReflectionMethod
     * @throws ReflectionException
     */
    protected function getPrivateMethod($class, $method)
    {
        $reflector = new ReflectionClass($class);
        $method = $reflector->getMethod($method);
        $method->setAccessible(true);

        return $method;
    }

    /**
     * Call Private Method
     *
     * @param object $class    Name of the class
     * @param string $property Name of the Property
     *
     * @return mixed
     * @throws ReflectionException
     */
    protected function getProperty($class, $property)
    {
        $property = $this->getPrivateProperty($class, $property);
        return $property->getValue($class);
    }

    /**
     * Call Private Method
     *
     * @param object $class  Name of the class
     * @param string $method Name of the Method
     * @param mixed  $args   Arguments to pass to method
     *
     * @return mixed
     * @throws ReflectionException
     */
    protected function callMethod($class, $method, $args)
    {
        $request = $this->getPrivateMethod($class, $method);
        return $request->invokeArgs($class, $args);
    }
    
}
