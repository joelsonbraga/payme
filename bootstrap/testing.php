<?php

$connection = new PDO("pgsql:host=postgres", 'payme', '12345');
$connection->query('DROP DATABASE IF EXISTS "payme-back-test"');
$connection->query('CREATE DATABASE "payme-back-test"');

require('vendor/autoload.php');
