<?php

declare(strict_types=1);

require_once('../includes/errors.php');
require_once('../includes/template.php');
require_once('../includes/request.php');

function renderRegister(): void
{
    require_once('../templates/register.php');
}

requestAllowMethods(['GET', 'POST']);

$user = [
    'username' => null,
    'password' => null,
];

if (requestMethodIs('POST')) {
    requestValidateCSRF();
    $user = requestGetPostParameters([
        'username' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        'password' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
    ]);
} else {
    requestGenerateCSRF();
}

renderHeader();
renderRegister();
renderFooter();
