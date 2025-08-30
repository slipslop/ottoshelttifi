<?php

declare(strict_types=1);

require_once('../includes/errors.php');
require_once('../includes/database.php');
require_once('../includes/template.php');
require_once('../includes/request.php');
require_once('../includes/validate.php');
require_once('../includes/auth.php');
require_once('../includes/escape.php');
require_once('../includes/sanitize.php');

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

    $user['username'] = sanitizeUsername($user['username']);

    $errors['username'] = validateUsername($user['username']);
    $errors['username'] = validateRequired($user['username'], 'Username');
    if (!isset($errors['username']) && !databaseIsUniqueUsername($user['username'])) {
        $errors['username'] = 'Username is taken';
    }
    $errors['password'] = validateRequired($user['password'], 'Password');
    $errors['password'] = validateRequired($user['password_confirm'], 'Password');
    $errors['password'] = validatePassword($user['password'], $user['password_confirm']);

    if (!validateHasErrors($errors)) {
        if (databaseInsertNewUser($user['username'], password_hash($user['password'], PASSWORD_DEFAULT))) {
            requestRedirectTo('login.php');
        } else {
            requestTerminate(403);
        }
    }
}

$user = escapeArrayOfValues($user);

requestGenerateCSRF();
renderHeader();
renderRegister($user, $errors);
renderFooter();
