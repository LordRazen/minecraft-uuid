# minecraft-uuid-converter
A PHP Library to convert the three different Minecraft UUID-Formats.

Official Minecraft Wiki about UUIDs:
https://minecraft.fandom.com/wiki/Universally_unique_identifier

## UUID Formats
Regular UUIDs (Hyphenated Hexadecimal):
`ea3bc3ec-7051-4efc-87f9-68635c9b473a`

Trimmed UUIDs (Hexadecimal):
`ea3bc3ec70514efc87f968635c9b473a`

UUIDs as Integer Arrays (Int-Array):
`[I;-365181972,1884376828,-2013697949,1553680186]`

## How to use this class to convert UUIDs
Create a new UUID object:
`$uuid = new UUID();`

Read a given UUID String (String can have any format from above):
`$uuid->read($input);`

Generate a new, random UUID:
`$uuid->generateNew();`

Return the converted UUIDs:
```
$uuid->getUuid();
$uuid->getUuidTrimmed();
$uuid->getUuidInt();
```