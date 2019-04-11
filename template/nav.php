<?php
$queryCategories = $pdo->prepare("SELECT * FROM categories");
$queryCategories->execute();

function displayCategories($query) {
  while ($row = $query->fetch()) {
    $categorieText = capitalize($row['categories']);
    $categorieId = $row['categories_id'];
    $isActive = isActive($categorieId);
    echo "<a class='nav-link $isActive' href='index.php?column=categories&value=$categorieId'>$categorieText</a>";
  }
}

function isActive($id) {
  if (isset($_GET['column']) && $_GET['column'] === 'categories')
    if ($id == $_GET['value'])
      return ' active';
}
?>

<nav class="nav">
  <div class="container-nav">
  <?= displayCategories($queryCategories); ?>
  </div>
</nav>
