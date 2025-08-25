<?php
declare(strict_types=1);

session_start();

function authGenerateCSRF(): void
{
    $token = bin2hex(random_bytes(32));
    $_SESSION['csrf_token'] = $token;
}

function authGetCSRF(): string
{
    return $_SESSION['csrf_token'];
}
