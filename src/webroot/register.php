<?php
declare(strict_types=1);

require_once('../includes/errors.php');
require_once('../includes/template.php');

function renderRegister(): void
{
  require_once('../templates/register.php');
}

renderHeader();
renderRegister();
renderFooter();
?>
