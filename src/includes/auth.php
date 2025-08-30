<?php
declare(strict_types=1);

session_start();

function authRequireLoggedIn(): void
{
    $userId = (int) $_SESSION['user_id'] ?? 0;

    if ($userId === 0) {
        header('Location: /login.php');
        exit;
    }
}
