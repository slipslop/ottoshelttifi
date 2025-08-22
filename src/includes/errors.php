<?php
declare(strict_types=1);

ob_start();

function exceptionHandler(Throwable $e): void
{
    ob_end_clean();
    http_response_code(500);
    header('Content-Type: text/plain');

    print($e);
    exit;
}

function errorHandler(int $errorCode, string $error, ?string $filename, ?int $lineNumber, ?array $context): void
{
    ob_end_clean();
    http_response_code($errorCode);
    header('Content-Type: text/plain');

    print($error);
    exit;
}

set_error_handler('errorHandler');
set_exception_handler('exceptionHandler');
