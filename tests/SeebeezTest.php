<?php

use SeebeezPHP\Seebeez;
use PHPUnit\Framework\TestCase;

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
    //    public function testConstructor(): void
    //    {
    //
    //    }

    /**
     * Example test case
     * 
     * @return void
     */
    public function testSum(): void
    {
        $this->assertEquals(
            '3',
            Seebeez::sum(1, 2)
        );
    }
}
