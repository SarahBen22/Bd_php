<?php
require_once './helpers/global.php';
require_once './helpers/helpers.php';
require_once './controllers/connect.php';

function getModalDetail(string $column, array $data) :?string {
  global $translation;

  if (isset($data["$column"])) {
    $value = $column . '_id';
    $label = $translation["$column"];
    $link = "index.php?column=$column&value={$data[$value]}";
    $text = capitalize($data[$column]);
    $listItem = "<li>$label : <strong><a href='$link'>$text</a></strong></li>";
    return $listItem;
  }

  return null;
}

$sqlQuery = $pdo->prepare("SELECT * FROM AllProducts WHERE ref = ? LIMIT 1");
$sqlQuery->execute([strtoupper($_GET['ref'] ?? null)]);
$data = $sqlQuery->fetch();

$ref = strtolower($data['ref']);
$imgSrc = in_array("$ref.jpg", scandir('img')) === true ? $ref : 'defaut';

$title = capitalize($data['title']);
$author = getModalDetail('author', $data);
$heroes = getModalDetail('heroes', $data);
$categories = getModalDetail('categories', $data);
$editor = getModalDetail('editor', $data);
$synopsis = $data['synopsis'] ?: 'Pas de résumé disponible';


$productDetail = <<<PRODUCT_DETAIL
  <div class='product-detail grid'>
    <img src='img/$imgSrc.jpg'/>
    <h3>$title</h3>
    <ul>
      $author
      $heroes
      $categories
      $editor
    </ul>
    <hr>
    <div>$synopsis</div>
  </div>
PRODUCT_DETAIL;

echo $productDetail;
?>
