# Minecraft UUID
A PHP Library to convert between three of the different Minecraft UUID-Formats.

Official Minecraft Wiki about UUIDs:
https://minecraft.fandom.com/wiki/Universally_unique_identifier


## Installation
`composer require lordrazen/minecraft-uuid`

## How to use this class to convert UUIDs
Create a new UUID object (you can pass any valid UUID form to the constructor):        
`$uuid = new UUID("ea3bc3ec-7051-4efc-87f9-68635c9b473a");`

Generate a new, random UUID:        
`$uuid = new UUID();`

## UUID Formats
Regular UUIDs (Hyphenated Hexadecimal):        
`ea3bc3ec-7051-4efc-87f9-68635c9b473a`

Trimmed UUIDs (Hexadecimal):        
`ea3bc3ec70514efc87f968635c9b473a`

UUIDs as Integer Arrays (Int-Array):        
`[I;-365181972,1884376828,-2013697949,1553680186]`


## Minecraft UUID Formats

Uuid:        
`ea3c1edf-80cb-8efc-87f9-68635c9b473a`

UuidTrimmed:         
`ea3c1edf80cb8efc87f968635c9b473a`

UuidInt:         
`[I;-365158689,-2134143236,-2013697949,1553680186]`

UuidInt2:        
`[-365158689,-2134143236,-2013697949,1553680186]`

UUIDMost (Deprecated with 1.16):        
`-1568344624944410884L`

UUIDLeast (Deprecated with 1.16):        
`-8648766833423595718L` 


## Return the UUID Formats
```
$uuid->getUuid();
$uuid->getUuidTrimmed();
$uuid->getUuidInt();
$uuid->getUuidInt2();
```
<br>
<hr>
www.minecraft-heads.com

![Minecraft Heads Banner](https://images.minecraft-heads.com/banners/minecraft-heads_halfbanner_234x60.png)