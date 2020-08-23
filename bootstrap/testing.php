<?php

$connection = new PDO("pgsql:host=postgres", 'stilldelivery', '12345');
$connection->query('DROP DATABASE IF EXISTS "still-delivery-back-test"');
$connection->query('CREATE DATABASE "still-delivery-back-test"');

require('vendor/autoload.php');