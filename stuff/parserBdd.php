<?php
require_once '../controller/bdo-connect.php';
require_once '../helpers/helpers.php';

/* Parse file into the database */
$file = array_slice(file("data.tsv",  FILE_SKIP_EMPTY_LINES), 1);

function insertAndGetId($pdo, $table, $value) {
  $querySelect = $pdo->prepare("SELECT id FROM $table WHERE $table = ?");
  $querySelect->execute([$value]);
  $querySelect = $querySelect->fetch();
  $getId = $querySelect["id"];

  if ($getId === null && $value !== '') {
    $queryInsert = "INSERT ignore INTO $table VALUES (NULL, ?)";
    $pdo->prepare($queryInsert)->execute([$value]);
    $lastId = $pdo->lastInsertId();
    return $lastId;
  } else {
    return $getId;
  }
}

foreach ($file as $line) {
  $lineArray = explode(";", $line);

  $author_id = insertAndGetId($pdo, 'author', $lineArray[1]);
  $heroes_id = insertAndGetId($pdo, 'heroes', $lineArray[2]);
  $categories_id = insertAndGetId($pdo, 'categories', $lineArray[7]);
  $editor_id = insertAndGetId($pdo, 'editor', $lineArray[9]);
  $supplier_id = insertAndGetId($pdo, 'supplier', $lineArray[11]);

  $dataQuery = [
    $lineArray[0], $author_id, $heroes_id, $lineArray[3],
    $lineArray[5], $lineArray[6], $categories_id, $lineArray[8],
    $editor_id, $lineArray[10], $supplier_id, $lineArray[12],
  ];

  $queryProduct = "INSERT ignore INTO products
    VALUES (NULL, ?,?,?,?,?,?,?,?,?,?,?,?)";
  $pdo->prepare($queryProduct)->execute($dataQuery);
}

// Fetch the database
/*
$SQL =
 "SELECT products.id, ref, author.author, heroes.heroes, title,
  public_price, editor_price, categories.categories, ref_editor,
  editor.editor, ref_supplier, supplier.supplier, synopsis FROM products
  LEFT JOIN author     ON author_id     = author.id
  LEFT JOIN heroes     ON heroes_id     = heroes.id
  LEFT JOIN categories ON categories_id = categories.id
  LEFT JOIN editor     ON editor_id     = editor.id
  LEFT JOIN supplier   ON supplier_id   = supplier.id
";

$querySelect = $pdo->prepare($SQL);
$querySelect->execute();
$querySelect = $querySelect->fetchAll();
consoleLog($querySelect);

echo "Done";
*/
?>
