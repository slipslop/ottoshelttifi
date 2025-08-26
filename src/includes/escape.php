<?php

declare(strict_types=1);

function escapeArrayOfValues(array $values): array
{
    return array_map(function ($value) {
        if ($value !== null) {
            return htmlspecialchars($value);
        }
    }, $values);
}
