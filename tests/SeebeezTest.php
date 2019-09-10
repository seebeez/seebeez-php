<?php

use SeebeezPHP\Seebeez;
use PHPUnit\Framework\TestCase;

use Exception;
use GuzzleHttp\Exception\ClientException;

/**
 * PHP test class for Seebeez Library.
 * 
 * @category Test
 * @package  SeebeezPHP
 * @author   Kazi Lotus <kazilotus@hotmail.com>
 * @license  https://www.apache.org/licenses/LICENSE-2.0.txt Apache-2.0
 * @version  Release: @1.0@
 * @link     https://seebeez.com
 */
final class SeebeezTest extends TestCase
{
    /**
     * Seebeez Class constructor
     * 
     * @return void
     */
    public function testConstructorThrowsExceptionOnInvalidURL(): void
    {
        try {
            new Seebeez('test', 'test');
        } catch (Exception $e) {
            $message = $e->getMessage();
        }
        $this->assertContains("Seebeez API URL is invalid", $message);
    }

    /**
     * Seebeez Class constructor
     * 
     * @return void
     */
    // public function testCanCreate(): void
    // {
    //     $test_config = [];
    //$s = new Seebeez('http://www.mocky.io/v2/5d76105f3200005600297826', 'test');
    //     $res = $sbz->create(json_encode($test_config));
    //     print_r($res);
    //     // $this->assertEquals();
    // }

    /**
     * Seebeez Class constructor
     * 
     * @return void
     */
    // public function testCanGet(): void
    // {
    //     try {
    //         $test_config = [];
    //         $s = new Seebeez('https://alpha.seebeez.com/api/v1', 'test');
    //         $res = $s->create(json_encode($test_config));
    //     } catch (Exception $e) {
    //         $message = $e->getMessage();
    //     }
    //     $this->assertContains('401 Unauthorized', $message);
    // }

    /**
     * Test simple request
     * 
     * @return void
     */
    public function testCanRequest(): void
    {
        $sbz = new Seebeez('http://www.mocky.io/v2/5d760c763100006f90950825', '');
        $request = self::callMethod($sbz, '_request', ["POST", '', []]);
        $this->assertEquals("test", $request);
    }

    /**
     * Test simple request with leading forward slash
     * 
     * @return void
     */
    public function testCanRequestWithSlash(): void
    {
        $sbz = new Seebeez('http://www.mocky.io/v2/5d760c763100006f90950825', '');
        $request = self::callMethod($sbz, '_request', ["POST", '/', []]);
        $this->assertEquals("test", $request);
    }

    /**
     * Test invalid url request exception
     * 
     * @return void
     */
    public function testRequestInvalidURLException(): void
    {
        try {
            $sbz = new Seebeez('https://test', '');
            self::callMethod($sbz, '_request', ["POST", '', []]);
        } catch (Exception $e) {
            $message = $e->getMessage();
        }
        $this->assertContains("Could not resolve host: test", $message);
    }

    /**
     * Test job Id setter and getter
     * 
     * @return void
     */
    public function testSetGetID(): void
    {
        $test_id = 12345;
        $sbz = new Seebeez('https://localhost', '');
        $sbz->setId($test_id);
        $id = $sbz->getId();
    
        $this->assertEquals($test_id, $id);
    }

    /**
     * Helper to make private methods accessible
     * 
     * @param object $obj  Object instance
     * @param string $name Function name
     * @param array  $args Function arguments
     * 
     * @return mixed
     */
    protected static function callMethod($obj, string $name, array $args)
    {
        $class = new \ReflectionClass($obj);
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        return $method->invokeArgs($obj, $args);
    }
}
