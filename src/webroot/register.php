<?php

declare(strict_types=1);

require_once('../includes/errors.php');
require_once('../includes/database.php');
require_once('../includes/template.php');
require_once('../includes/request.php');
require_once('../includes/validate.php');
require_once('../includes/auth.php');
require_once('../includes/escape.php');

function renderRegister(array $user, array $errors): void
{
    require_once('../templates/register.php');
}

requestAllowMethods(['GET', 'POST']);

$user = [
    'username' => null,
    'password' => null,
];

$errors = [];

if (requestMethodIs('POST')) {
    validateCSRF();
    $user = requestGetPostParameters([
        'username' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        'password' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        'password_confirm' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
    ]);

    $errors['username'] = validateUsername($user['username']);
    if (!isset($errors['username']) && !databaseIsUniqueUsername($user['username'])) {
        $errors['username'] = 'Username is taken';
    }
    $errors['password'] = validatePassword($user['password'], $user['password_confirm']);

    if (!validateHasErrors($errors)) {
        $password_hash = password_hash($user['password'], PASSWORD_DEFAULT);

        $connection = databaseGetConnection();
        $statement = $connection->prepare("INSERT INTO users (username, password) values (:username, :password)");
        $statement->bindParam('username', $user['username'], PDO::PARAM_STR);
        $statement->bindParam('password', $password_hash, PDO::PARAM_STR);
        if ($statement->execute()) {
            requestRedirectTo('login.php');
        } else {
            requestTerminate(403);
        }
    }
} else {
    authGenerateCSRF();
}

$user = escapeArrayOfValues($user);

renderHeader();
renderRegister($user, $errors);
renderFooter();
