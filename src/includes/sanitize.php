<?php
declare(strict_types=1);

function sanitizeUsername(string $username): string
{
    return trim($username);
}
