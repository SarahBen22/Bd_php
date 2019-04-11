<?php
require_once '../controllers/connect.php';
require_once '../helpers/helpers.php';

function deleteFromBasket(?string $ref): ?int {
  if ($ref === null) {
    return null;
  }

  unset($_SESSION['basket'][$_GET['ref']]);
  return null;
}

deleteFromBasket($_GET['ref'] ?? null);
$redirectTo = sendBack();
header("location: $redirectTo");
