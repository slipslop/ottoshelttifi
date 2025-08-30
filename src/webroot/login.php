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

function renderLogin(array $user, array $errors): void
{
    require_once('../templates/login.php');
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
    ]);
    $user['username'] = sanitizeUsername($user['username']);
    $errors['error'] = validateRequired($user['username'], 'Username');
    $errors['error'] = validateRequired($user['password'], 'Password');

    if (!validateHasErrors($errors)) {
        $userRow = databaseGetUserByUsername($user['username']);
        if (!$userRow || !password_verify($user['password'], $userRow['password'])) {
            $errors['error'] = 'Wrong username or password';
        } else {
            if (password_needs_rehash($userRow['password'], PASSWORD_DEFAULT)) {
                databaseUpdateUserPasswordById($userRow['id'], password_hash($plainTextPassword, PASSWORD_DEFAULT));
            }
    
            $_SESSION['user_id'] = $userRow['id'];
            requestRedirectTo('users.php');
        }
    }
}

$user = escapeArrayOfStrings($user);

requestGenerateCSRF();
renderHeader();
renderLogin($user, $errors);
renderFooter();
