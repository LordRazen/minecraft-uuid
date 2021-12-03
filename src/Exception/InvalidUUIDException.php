<?php

/**
 * InvalidUUIDException
 *
 * @package			MinecraftLibrary
 * @author			LordRazen <http://www.minecraft-heads.com>	
 * @copyright		Copyright (C) 2020. All Rights Reserved
 */

namespace Minecraft\Exception;

use Exception;

class InvalidUUIDException extends Exception
{
    protected $message = 'This is not a valid UUID!';
}
