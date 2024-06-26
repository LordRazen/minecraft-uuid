<?php

/**
 * UUID Management, Convert UUID between three of the representations
 * 
 * https://minecraft.fandom.com/wiki/Universally_unique_identifier
 * https://www.soltoder.com/mc-uuid-converter/
 * https://www.rapidtables.com/convert/number/hex-to-decimal.html
 *
 * Uuid:        ea3c1edf-80cb-8efc-87f9-68635c9b473a
 * UuidTrimmed: ea3c1edf80cb8efc87f968635c9b473a
 * UuidInt:     [I;-365158689,-2134143236,-2013697949,1553680186]
 * UuidInt2:    [-365158689,-2134143236,-2013697949,1553680186]
 * 
 * UUIDMost:    -1568344624944410884L - Deprecated with 1.16
 * UUIDLeast:   -8648766833423595718L - Deprecated with 1.16
 *
 * @package		    Minecraft Heads
 * @author			LordRazen <http://www.minecraft-heads.com>	
 * @copyright		Copyright (C) 2020. All Rights Reserved
 */

namespace Minecraft;

use Minecraft\Exception\InvalidUUIDException;
use Ramsey\Uuid\Uuid as RandomUuid;

class UUID
{
    const TYPE = 'UUID';
    const MARKER = 'I';

    private string $uuid;         # UUID Regular
    private string $uuidTrimmed;  # UUID Trimmed
    private string $uuidInt;      # UUIDInt as String
    private string $uuidInt2;      # UUIDInt as String
    private array  $uuidIntArray = array(); # Array with the values for UUIDInt

    const PATTERN_UUID         = '#([0-9a-fA-F]{8}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{12})#';
    const PATTERN_UUID_TRIMMED = '#([0-9a-fA-F]{32})#';
    const PATTERN_UUID_INT     = '#\[I;(-?[0-9]*),(-?[0-9]*),(-?[0-9]*),(-?[0-9]*)\]#';

    /**
     * Constructor
     * 
     * @param string $input
     */
    public function __construct(string $input = '')
    {
        # Check if the $input is not empty
        if (!empty($input)) {
            $this->readUuid($input);
        }
        # Create new Random UUID
        else {
            $this->generateRandomUuid();
        }
    }

    /**
     * Read UUID String
     * 
     * @param string $input
     * @throws InvalidUUIDException
     */
    private function readUuid(string $input): void
    {
        # Match UUID
        if (preg_match(self::PATTERN_UUID, $input, $matches) > 0) {
            $this->uuid = trim($matches[0]);
            $this->generateOtherUUIDFormats();
        }
        # Match UUID (Trimmed)
        else if (preg_match(self::PATTERN_UUID_TRIMMED, $input, $matches) > 0) {
            $this->uuidTrimmed = trim($matches[0]);
            $this->generateOtherUUIDFormats();
        }
        # Match UUID (Int) as String
        else if (preg_match(self::PATTERN_UUID_INT, $input, $matches) > 0) {
            $this->uuidInt = trim($matches[0]);
            $this->generateOtherUUIDFormats();
        }
        # Nothing found
        else {
            throw new InvalidUUIDException();
        }
    }

    /**
     * Generate new random UUID
     */
    private function generateRandomUuid(): void
    {
        $this->uuid = RandomUuid::uuid4()->toString();
        $this->generateOtherUUIDFormats();
    }

    /**
     * Generate other UUID Formats
     */
    private function generateOtherUUIDFormats(): void
    {
        # UUID Reg exists
        if (isset($this->uuid)) {
            $this->convertRegToTrim();
            $this->convertTrimToIntArray();
            $this->convertIntArrayToInt();
        }
        # UUID Trimmed exists
        else if (isset($this->uuidTrimmed)) {
            $this->convertTrimToReg();
            $this->convertTrimToIntArray();
            $this->convertIntArrayToInt();
        }
        # UUID Int exists as String
        else if (isset($this->uuidInt)) {
            $this->convertIntToIntArray();
            $this->convertIntArrayToTrim();
            $this->convertTrimToReg();
            $this->convertIntArrayToInt(); # Redo this to get Int2
        }
    }

    /**
     * Method to convert UUID (Regular) to UUID (Trimmed)
     */
    private function convertRegToTrim(): void
    {
        $this->uuidTrimmed = str_replace('-', '', $this->uuid);
    }

    /**
     * Method to convert UUID (Trimmed) to UUID (IntArray)
     */
    private function convertTrimToIntArray(): void
    {
        # Split UUIDTrimmed into parts of 8 digits
        $parts = str_split($this->uuidTrimmed, 8);

        # Convert every part into signed int
        foreach ($parts as $part) {
            # Convert Hex to Int
            $partConv = hexdec($part);

            # Convert unsigned to signed Int
            if (PHP_INT_SIZE == 8) {
                if ($partConv > 0x7FFFFFFF) {
                    $partConv -= 0x100000000;
                }
            }

            # Add part to $result array
            array_push($this->uuidIntArray, $partConv);
        }
    }

    /**
     * Method to convert UUID (IntArray) to UUID (Int)
     */
    private function convertIntArrayToInt(): void
    {
        $result = '';
        foreach ($this->uuidIntArray as $number) {
            $result .= (empty($result)) ? $number : "," . $number;
        }
        $this->uuidInt = "["  . self::MARKER . ";" . $result . "]";
        $this->uuidInt2 = "[" . $result . "]";
    }

    /**
     * Method to convert UUID (Trimmed) to UUID (Regular)
     */
    private function convertTrimToReg(): void
    {
        $result = $this->uuidTrimmed;
        $result = substr_replace($result, '-', 8, 0);
        $result = substr_replace($result, '-', 13, 0);
        $result = substr_replace($result, '-', 18, 0);
        $result = substr_replace($result, '-', 23, 0);
        $this->uuid = $result;
    }

    /**
     * Method to convert UUID (Int) to UUID (Trimmed)
     */
    private function convertIntArrayToTrim(): void
    {
        $result = '';
        foreach ($this->uuidIntArray as $number) {
            # Negative Int Fix
            if ($number < 0) {
                $number += 0x100000000;
            }
            # Add line to a string, must be 8 digits, so fill it up with "0" on the left side
            $result .= str_pad((string)dechex($number), 8, "0", STR_PAD_LEFT);
        }
        $this->uuidTrimmed = $result;
    }

    /**
     * Method to convert UUID (Int) to UUID (IntArray)
     */
    private function convertIntToIntArray(): void
    {
        preg_match(self::PATTERN_UUID_INT, $this->uuidInt, $matches);
        unset($matches[0]);
        $this->uuidIntArray = $matches;
    }

    /**
     * get UUID:
     * ea3c1edf-80cb-8efc-87f9-68635c9b473a
     * 
     * @return string $uuid
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * get UUID Trimmed:
     * ea3c1edf80cb8efc87f968635c9b473a
     * 
     * @return string $uuid
     */
    public function getUuidTrimmed(): string
    {
        return $this->uuidTrimmed;
    }

    /**
     * get UUID IntForm: 
     * [I;-365158689,-2134143236,-2013697949,1553680186]
     * 
     * @return string $uuid
     */
    public function getUuidInt(): string
    {
        return $this->uuidInt;
    }

    /**
     * get UUID IntForm 2: 
     * Only used in LootTables
     * [-365158689,-2134143236,-2013697949,1553680186]
     * 
     * @return string $uuid
     */
    public function getUuidInt2(): string
    {
        return $this->uuidInt2;
    }
}
