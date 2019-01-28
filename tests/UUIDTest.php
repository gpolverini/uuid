<?php

namespace UUID;

use PHPUnit\Framework\TestCase;

/**
 * @author Gabriel Polverini <polverini.gabriel@gmail.com>
 */
class UUIDTest extends TestCase
{
    protected $uuid;

    public function setUp()
    {
        $this->uuid = new UUID();
    }

    /**
     * @test
     */
    public function testFormatInvalidInput()
    {
        $this->assertFalse($this->uuid->v4(hex2bin('112daf396a22623d73b7')));
    }

    /**
     * @test
     */
    public function testFormatOK()
    {
        $this->assertEquals(
            '39AF2D11-226A-3D62-73B7-FD2428612A1E',
            $this->uuid->v4(hex2bin('112daf396a22623d73b7fd2428612a1e'))
        );
    }

    /**
     * @test
     */
    public function testVersion4()
    {
        $guid = $this->uuid->v4();
        $this->assertTrue(preg_match('/^[0-9a-f]{8}(-[0-9a-f]{4}){3}-[0-9a-f]{12}$/i', $guid) !== false);
    }

    /**
     * @test
     */
    public function testGenerate()
    {
        $reflection = new \ReflectionClass($this->uuid);
        $method = $reflection->getMethod('generate');
        $method->setAccessible(true);

        $this->assertFalse($method->invoke($this->uuid, 0));
    }
}
