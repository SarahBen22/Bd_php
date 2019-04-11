<?php
require_once '../controllers/connect.php';
require_once '../helpers/helpers.php';

function removeFromBasket(?string $ref): ?int { // ? = paramètre optionnel
  if ($ref === null) {
    return null;
  }// fonction pour enlever un element selectionné

  if ($_SESSION['basket'][$_GET['ref']] === 1) {
    unset($_SESSION['basket'][$_GET['ref']]);
    return null;
  }

  return $_SESSION['basket'][$_GET['ref']] -= 1;
}

removeFromBasket($_GET['ref'] ?? null);
$redirectTo = sendBack();
header("location: $redirectTo");


