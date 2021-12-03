<?php

require_once(dirname(__FILE__) . '/../vendor/autoload.php');

use Minecraft\UUID;

# Generate new UUID
echo 'Generate Random UUID:';
$uuid1 = new UUID(UUID::RANDOM);
var_dump($uuid1->getUuid());
var_dump($uuid1->getUuidInt());
var_dump($uuid1->getUuidTrimmed());

echo '<hr>';

# Read UUID
echo 'Read UUID in any form:';
$uuid2 = new UUID('5032b960-b30a-4b9b-9f05-f90aae1e0dd4');
var_dump($uuid2->getUuid());
var_dump($uuid2->getUuidInt());
var_dump($uuid2->getUuidTrimmed());

echo '<hr>';

$uuid3 = new UUID('5032b960b30a4b9b9f05f90aae1e0dd4');
var_dump($uuid3->getUuid());
var_dump($uuid3->getUuidInt());
var_dump($uuid3->getUuidTrimmed());

echo '<hr>';

$uuid4 = new UUID('[I;1345501536,-1291170917,-1626998518,-1373762092]');
var_dump($uuid4->getUuid());
var_dump($uuid4->getUuidInt());
var_dump($uuid4->getUuidTrimmed());
