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

function databaseIsUniqueUsername(string $username): bool
{
    $connection = databaseGetConnection();
    $statement = $connection->prepare('SELECT id FROM users WHERE username = :username');
    $statement->bindParam('username', $username, PDO::PARAM_STR);
    $statement->execute();

    return $statement->rowCount() === 0;
}

function databaseInsertNewUser(string $username, string $password): bool
{
    $connection = databaseGetConnection();
    $statement = $connection->prepare("INSERT INTO users (username, password) values (:username, :password)");
    $statement->bindParam('username', $username, PDO::PARAM_STR);
    $statement->bindParam('password', $password, PDO::PARAM_STR);
    return $statement->execute();
}

function databaseGetUserByUsername(string $username): array|false
{
    $connection = databaseGetConnection();
    $statement = $connection->prepare('SELECT id, password FROM users WHERE username = :username');
    $statement->bindParam('username', $username, PDO::PARAM_STR);
    $statement->execute();

    if ($statement->rowCount() !== 1) {
        return false;
    }

    return $statement->fetch();
}

function databaseUpdateUserPasswordById(int $userId, string $password): bool
{
    $connection = databaseGetConnection();
    $statement = $connection->prepare("UPDATE users SET password = :password WHERE id = :id LIMIT 1");
    $statement->bindParam('id', $userId, PDO::PARAM_STR);
    $statement->bindParam('password', $password, PDO::PARAM_STR);
    return $statement->execute();
}
