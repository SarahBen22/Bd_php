<?php

$products = [];

foreach ($_SESSION['basket'] as $key => $value) {
  $ref = strtoupper($key);
  $query = $pdo->prepare("SELECT * FROM AllProducts WHERE ref = '$ref' LIMIT 1");
  $query->execute();
  $productData = $query->fetch();

  if ($productData !== false) {
    $productData["quantity"] = $value;
    $products[$key] = $productData;
  }
}
