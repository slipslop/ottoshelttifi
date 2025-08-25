<?php

declare(strict_types=1);

function validateCSRF(): void
{
    $providedToken = filter_input(INPUT_POST, 'csrf_token', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if (!$providedToken || $providedToken !== $_SESSION['csrf_token']) {
        http_response_code(403);
        exit;
    }
}

function validateUsername(string $username): ?string
{
    if (!ctype_alnum($username)) {
        return "Username can only contain letters and digits";
    }

    if (mb_strlen($username) < 3 || mb_strlen($username) > 32) {
        return "Username length must be between 3 and 32";
    }

    return null;
}

function validatePassword(string $password, string $confirmPassword): ?string
{
    if (!ctype_graph($password)) {
        return "Password contains invalid letters";
    }

    if (mb_strlen($password) > 64) {
        return "Given password is too long. Maximum length is 64";
    }

    if ($password !== $confirmPassword) {
        return "Passwords do not match";
    }

    return null;
}

function validateHasErrors(array $errors): bool
{
    foreach ($errors as $error) {
        if ($error !== null) {
            return true;
        }
    }

    return false;
}
