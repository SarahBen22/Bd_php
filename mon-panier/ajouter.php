<?php
require_once '../controllers/connect.php';
require_once '../helpers/helpers.php';

function addToBasket(?string $ref): ?int {
  if ($ref === null) {
    return null;
  }

  if (isset($_SESSION['basket'][$ref])) {
    return $_SESSION['basket'][$ref] += 1;
  }

  return $_SESSION['basket'][$_GET['ref']] = 1;
}

addToBasket($_GET['ref'] ?? null);
$redirectTo = sendBack();
header("location: $redirectTo");
