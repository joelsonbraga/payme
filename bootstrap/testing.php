<?php

$connection = new PDO("pgsql:host=postgres", 'payme', '12345');
$connection->query('DROP DATABASE IF EXISTS "payme-test"');
$connection->query('CREATE DATABASE "payme-test"');

require('vendor/autoload.php');
