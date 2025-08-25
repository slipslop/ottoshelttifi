<?php
declare(strict_types=1);

session_start();

function requestAllowMethods(array $allowedMethods): void
{
    if (!isset($_SERVER['REQUEST_METHOD']) || !in_array($_SERVER['REQUEST_METHOD'], $allowedMethods)) {
        http_response_code(403);
        exit;
    }
}

function requestMethodIs(string $method): bool
{
    return isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === $method;
}

function requestGetPostParameters(array $input): array
{
    return filter_input_array(INPUT_POST, $input, add_empty: true);
}

function requestGenerateCSRF(): void
{
    $token = bin2hex(random_bytes(32));
    $_SESSION['csrf_token'] = $token;
}

function requestValidateCSRF(): void
{
    $providedToken = filter_input(INPUT_POST, 'csrf_token', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if ($providedToken !== $_SESSION['csrf_token']) {
        http_response_code(403);
        exit;
    }
}
