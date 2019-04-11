<?php
require_once './helpers/global.php';

$sqlQueryCount = "SELECT COUNT(*) FROM AllProducts";

if (isset($_GET['column']) && isset($_GET['value'])) {
  $column = $_GET['column'] . '_id' ;
  $sqlQueryCount = "SELECT COUNT(*) FROM AllProducts WHERE $column = ?";
  $sqlData = [$_GET['value']];
}

$sqlCount = $pdo->prepare($sqlQueryCount);
$sqlCount->execute($sqlData ?? null);

$numberOfItems = $sqlCount->fetchColumn();
$numberOfPages = ceil($numberOfItems / $itemsPerPage);

if ($numberOfPages == 1) {
  return;
}

function getLink($pageNumber) {
  $link = "index.php?page=$pageNumber";

  if (isset($_GET['column']) && isset($_GET['value'])) {
    $arrayQuery = [];
    parse_str($_SERVER['QUERY_STRING'], $arrayQuery);
    $column = $arrayQuery['column'];
    $value = $arrayQuery['value'];
    $link = "index.php?column=$column&value=$value&page=$pageNumber";
  }

  return $link;
}

$paginate = '';

for ($i=1; $i <= $numberOfPages ; $i++) {
  $selectedPage = $_GET['page'] ?? 1;
  $isActive = $selectedPage == $i ? 'active' : null;
  $link = getLink($i);

  $paginate .= "<a class='pages $isActive' href=$link>$i</a>";
}
