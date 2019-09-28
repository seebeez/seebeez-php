<?php

namespace SeebeezPHP\Tests;

use Exception;
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
final class SeebeezTest extends Helper
{

    /**
     * Test job can be dispatched
     *
     * @return void
     * @throws Exception
     */
    public function testCanCreate(): void
    {
        $sbz = new Seebeez(self::MOCK_API);
        $res = $sbz->create(json_encode([]));
        $this->assertEquals('dispatched', $res['status']);
    }

    /**
     * Test job can be requested
     *
     * @return void
     * @throws Exception
     */
    public function testCanGet(): void
    {
        $sbz = new Seebeez(self::MOCK_API);
        $sbz->setId('8e9c468d-250d-41b6-b2c2-f16a55fd27f6');
        $res = $sbz->get();
        $this->assertEquals('8e9c468d-250d-41b6-b2c2-f16a55fd27f6', $res['id']);
    }

    /**
     * Test invalid response returns empty array
     *
     * @return void
     * @throws Exception
     */
    public function testCanGetInvalidResponse(): void
    {
        $sbz = new Seebeez(self::MOCK_API);
        $sbz->setId('test-id');
        $res = $sbz->get();
        $this->assertEquals([], $res);
    }

    /**
     * Test job can be cancelled
     *
     * @return void
     * @throws Exception
     */
    public function testCanCancel(): void
    {
        $sbz = new Seebeez(self::MOCK_API);
        $sbz->setId('8e9c468d-250d-41b6-b2c2-f16a55fd27f6');
        $res = $sbz->cancel();
        $this->assertEquals('successful', $res['status']);
    }

    /**
     * Test api token setter
     *
     * @return void
     * @throws ReflectionException
     */
    public function testSetToken(): void
    {
        $test_token = 12345;
        $sbz = new Seebeez('https://localhost');
        $sbz->setToken($test_token);
        $token = $this->getProperty($sbz, 'api_token');
    
        $this->assertEquals($test_token, $token);
    }

    /**
     * Test job Id setter and getter
     * 
     * @return void
     */
    public function testSetGetID(): void
    {
        $test_id = 12345;
        $sbz = new Seebeez('https://localhost');
        $sbz->setId($test_id);
        $jid = $sbz->getId();
    
        $this->assertEquals($test_id, $jid);
    }

}
