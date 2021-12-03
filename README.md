# Minecraft UUID
A PHP Library to convert between three of the different Minecraft UUID-Formats.

Official Minecraft Wiki about UUIDs:
https://minecraft.fandom.com/wiki/Universally_unique_identifier

<br>

## Installation
`composer require lordrazen/minecraft-uuid`

<br>

## UUID Formats
Regular UUIDs (Hyphenated Hexadecimal):

```ea3bc3ec-7051-4efc-87f9-68635c9b473a```

Trimmed UUIDs (Hexadecimal):

`ea3bc3ec70514efc87f968635c9b473a`

UUIDs as Integer Arrays (Int-Array):

`[I;-365181972,1884376828,-2013697949,1553680186]`

<br>

## How to use this class to convert UUIDs
Create a new UUID object (you can pass any valid UUID form to the constructor):

`$uuid = new UUID("ea3bc3ec-7051-4efc-87f9-68635c9b473a");`

Generate a new, random UUID:

`$uuid = new UUID(UUID::RANDOM);`

Return the converted UUIDs:
```
$uuid->getUuid();
$uuid->getUuidTrimmed();
$uuid->getUuidInt();
```
<br>
<hr>
www.minecraft-heads.com

![Minecraft Heads Banner](https://minecraft-heads.com/images/banners/minecraft-heads_halfbanner_234x60.png)