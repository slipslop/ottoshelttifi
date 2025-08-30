<?php
declare(strict_types=1);

function requestAllowMethods(array $allowedMethods): void
{
    if (!isset($_SERVER['REQUEST_METHOD']) || !in_array($_SERVER['REQUEST_METHOD'], $allowedMethods)) {
        requestTerminate(403);
    }
}

function requestMethodIs(string $method): bool
{
    return isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === $method;
}

function requestGenerateCSRF(): void
{
    $token = bin2hex(random_bytes(32));
    $_SESSION['csrf_token'] = $token;
}

function requestGetCSRF(): string
{
    return $_SESSION['csrf_token'];
}

function requestTerminate(int $code): void
{
    http_response_code($code);
    exit;
}

function requestGetPostParameters(array $input): array
{
    return filter_input_array(INPUT_POST, $input, add_empty: true);
}

function requestRedirectTo(string $uri): void
{
    header("Location: /$uri");
}
