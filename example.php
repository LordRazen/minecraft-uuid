<?php

require("vendor/autoload.php");

use Minecraft\UUID;

// Generate new UUID
$uuid1 = new UUID();
$uuid1->generateNew();
echo $uuid1->getUuid();
echo $uuid1->getUuidInt();
echo $uuid1->getUuidTrimmed();

// Read UUID
$uuid2 = new UUID();
$uuid2->read('5032b960-b30a-4b9b-9f05-f90aae1e0dd4');
// $uuid2->read('5032b960b30a4b9b9f05f90aae1e0dd4');
// $uuid2->read('[I;1345501536,-1291170917,-1626998518,-1373762092]');
echo $uuid2->getUuid();
echo $uuid2->getUuidInt();
echo $uuid2->getUuidTrimmed();
