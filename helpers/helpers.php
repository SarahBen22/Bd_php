<?php
function consoleLog($arg) {
  print("<pre>");

  if (gettype($arg) === 'array') {
    print_r($arg);
  } elseif (gettype($arg) === 'string') {
    print($arg);
  } else {
    var_dump($arg);
  }

  print("</pre>");
}

function isNull($arg) {
  return $arg !== '' ? $arg : 'null';
}

function displayList($key, $value) {
  print_r([$key=>$value]);
  echo "<br>";
}

/** Capitalize the string passed */
function capitalize(string $arg): string {
  return ucwords(strtolower($arg));
}


function getColumnName() {
  global $pdo;
  if (isset($_GET['column']) && isset($_GET['value'])) {
    $table = $_GET['column'];
    $columnID = $table . '_id';
    $value = $_GET['value'];

    $sqlQuery = $pdo->prepare("SELECT * FROM $table WHERE $columnID = ? LIMIT 1");
    $sqlQuery->execute([$value]);
    $sqlResponse = capitalize($sqlQuery->fetch()[$table]);

    return $sqlResponse;
  }
}

/**
 * Send back to the last page or to '/'
 * if we're comming from the current page
 */
function sendBack(): string {
  if (
    isset($_SERVER['HTTP_REFERER']) === false ||
    strpos($_SERVER['HTTP_REFERER'], $_SERVER['PHP_SELF']) !== false
    ) {
    return "/";
  }

  return $_SERVER['HTTP_REFERER'];
}

/** Return the number of products added to the basket */
function sumBasket(array $basket): ?int {
  return array_reduce($basket, function ($acc, $curr) {
    $acc += $curr;
    return $acc;
  });
}

/** Return formated 'à la française' price */
function getFixedPrice(float $price): string {
  return number_format($price, 2, ',', ' ');
}
