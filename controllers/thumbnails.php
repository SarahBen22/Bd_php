<?php
require_once './helpers/global.php';

$offset = ($pageNumber - 1) * $itemsPerPage;
$query = "SELECT ref, public_price, title FROM AllProducts LIMIT $offset, $itemsPerPage";

if (isset($_GET['column']) && isset($_GET['value'])) {
  $column = $_GET['column'] . '_id' ;
  $value = $_GET['value'];
  $query = "SELECT ref, public_price, title FROM AllProducts WHERE $column = $value LIMIT $offset, $itemsPerPage";
}

$thumbnailsData = $pdo->prepare($query);
$thumbnailsData->execute();
