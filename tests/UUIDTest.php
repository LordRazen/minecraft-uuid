<?php

/**
 * Test of UUID Class
 *
 * @package		    Minecraft Heads
 * @author			LordRazen <http://www.minecraft-heads.com>	
 * @copyright		Copyright (C) 2020. All Rights Reserved
 */

use UUID\UUID;
use PHPUnit\Framework\TestCase;

class UUIDTest extends TestCase
{
    const UUID          = 'UUID';
    const INPUT         = 'Input';
    const UUID_REG      = 'Uuid';
    const UUID_TRIMMED  = 'UuidTrimmed';
    const UUID_INT      = 'UuidInt';

    /**
     * Test Random UUID
     *
     * @test
     */
    public function testUUIDRandom()
    {
        $randomUuids = array();
        for ($i = 0; $i < 10; $i++) {
            $uuid = new UUID();
            $uuid->generateNew();
            array_push($randomUuids, $uuid->getUUID());
        }
        $randomUuidsUnique = array_unique($randomUuids);

        # Ensure the size of the arrays is identical => no UUID was removed => all are unique
        $this->assertEquals(sizeof($randomUuidsUnique), sizeof($randomUuids));
    }

    /**
     * Read UUID from Strings
     *
     * @test
     * @dataProvider data
     */
    public function testUUIDString(array $data)
    {
        $testObject = new UUID();
        $testObject->read($data[self::INPUT]);

        $this->assertSame($data[self::UUID_REG], $testObject->getUuid());
        $this->assertSame($data[self::UUID_TRIMMED], $testObject->getUuidTrimmed());
        $this->assertSame($data[self::UUID_INT], $testObject->getUuidInt());
    }

    public function data()
    {
        return [
            [
                [
                    # Input UUID
                    self::INPUT => '87e2e6c2-7bf2-45e4-bc16-c98f02567eba',
                    self::UUID_REG => '87e2e6c2-7bf2-45e4-bc16-c98f02567eba',
                    self::UUID_TRIMMED => '87e2e6c27bf245e4bc16c98f02567eba',
                    self::UUID_INT => '[I;-2015172926,2079475172,-1139357297,39222970]'
                ]
            ],
            [
                [
                    # Input UUIDTrimmed
                    self::INPUT => '0940c3ad8d5a44eb94d40d9284554f8f',
                    self::UUID_REG => '0940c3ad-8d5a-44eb-94d4-0d9284554f8f',
                    self::UUID_TRIMMED => '0940c3ad8d5a44eb94d40d9284554f8f',
                    self::UUID_INT => '[I;155239341,-1923463957,-1798042222,-2074783857]'
                ]
            ],
            [
                [
                    # Input UUIDInt
                    self::INPUT => '[I;-1815670830,-950779804,-2121367803,440746606]',
                    self::UUID_REG => '93c70fd2-c754-4064-818e-7f051a45426e',
                    self::UUID_TRIMMED => '93c70fd2c7544064818e7f051a45426e',
                    self::UUID_INT => '[I;-1815670830,-950779804,-2121367803,440746606]'
                ]
            ]
        ];
    }
}
