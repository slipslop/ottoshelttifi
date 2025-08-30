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
    $length = mb_strlen($username);

    if ($length === 0) {
        return "Username is required";
    }

    if (!ctype_alnum($username)) {
        return "Username can only contain letters and digits";
    }

    if ($length < 3 || $length > 32) {
        return "Username length must be between 3 and 32";
    }

    return null;
}

function validatePassword(string $password, string $confirmPassword): ?string
{
    $length = mb_strlen($password);

    if ($length === 0) {
        return "Password is required";
    }

    if (!ctype_graph($password)) {
        return "Password contains invalid letters";
    }

    if ($length < 8 || $length > 64) {
        return "Password length must be between 8 and 64 characters";
    }

    if ($password !== $confirmPassword) {
        return "Passwords do not match";
    }

    return null;
}

function validateRequired(?string $input, string $fieldName): ?string
{
    if (
        is_null($input) ||
        $input === ''
    ) {
        return "$fieldName is required";
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
