<?php
declare(strict_types=1);

function databaseGetConnection(): PDO
{
    $user = getenv('MARIADB_USER');
    $pass = getenv('MARIADB_PASSWORD');
    $dbname = getenv('MARIADB_DATABASE');
    $host = getenv('MARIADB_HOST');

    return new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
}
