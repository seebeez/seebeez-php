<?php

namespace SeebeezPHP\Tests;

use ReflectionException;
use SeebeezPHP\Services;

/**
 * PHP test class for Services Library.
 *
 * @category Test
 *
 * @author   Kazi Lotus <kazilotus@hotmail.com>
 * @license  https://www.apache.org/licenses/LICENSE-2.0.txt Apache-2.0
 *
 * @version  Release: @1.0@
 *
 * @link     https://seebeez.com
 */
final class ServicesTest extends Helper
{
    /**
     * Test youtubeDL service.
     *
     * @throws ReflectionException
     *
     * @return void
     */
    public function testServiceYoutubeDL(): void
    {
        $svc = new Services(self::MOCK_API);
        $info = $svc->youtubeDL('test-link', 'test-format');
        $this->assertEquals('success', $info['status']);
    }

    /**
     * Test api token setter.
     *
     * @throws ReflectionException
     *
     * @return void
     */
    public function testSetToken(): void
    {
        $test_api = self::MOCK_API;
        $svc = new Services($test_api);
        $svc->setAPI($test_api);
        $url = $this->getProperty($svc, 'api_url');

        $this->assertEquals($test_api, $url);
    }
}
