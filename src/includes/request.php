<?php
declare(strict_types=1);

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
