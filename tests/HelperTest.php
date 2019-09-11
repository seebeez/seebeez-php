<?php

namespace SeebeezPHP\Tests;

use Exception;
use GuzzleHttp\Exception\ConnectException;
use ReflectionException;
use SeebeezPHP\Seebeez;

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
final class HelperTest extends Helper
{

    /**
     * Test simple request
     *
     * @return void
     * @throws Exception
     * @throws ReflectionException
     */
    public function testCanRequest(): void
    {
        $sbz = new Seebeez(self::MOCK_API);
        $res = $this->callMethod($sbz, 'request', ["GET", '/job/test-id', []]);
        $this->assertEquals("[]", $res);
    }

    /**
     * Test invalid url request exception
     *
     * @return void
     * @throws ReflectionException
     */
    public function testRequestInvalidURLException(): void
    {
        $this->expectException(ConnectException::class);
        $this->expectExceptionMessageMatches('/Could not resolve host/');
        $sbz = new Seebeez('https://test');
        $sbz->exception(
            function ($e) {
                throw $e;
            }
        );
        $this->callMethod($sbz, 'request', ["POST", '', []]);
    }

    /**
     * Test invalid url request exception
     *
     * @return void
     * @throws ReflectionException
     */
    public function testRequestExceptionWithNoReceiver(): void
    {
        $sbz = new Seebeez('test');
        $res = $this->callMethod($sbz, 'request', ["POST", '', []]);
        $this->assertEquals(null, $res);
    }

}
