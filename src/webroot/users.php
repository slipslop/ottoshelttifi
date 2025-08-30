<?php

declare(strict_types=1);

require_once('../includes/errors.php');
require_once('../includes/database.php');
require_once('../includes/template.php');
require_once('../includes/request.php');
require_once('../includes/validate.php');
require_once('../includes/auth.php');
require_once('../includes/escape.php');
require_once('../includes/sanitize.php');

authRequireLoggedIn();


echo 'all ok';
die;
