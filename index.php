<?php
require_once './template/header.php';
require_once './template/pagination.php';

require_once './controllers/thumbnails.php';
?>

<div class="modal" style="visibility: hidden;">
  <div class="loading"></div>
</div>
<div onclick="removeModal()" class="cover"></div>

<main class="main-thumbnails">
  <div class="container-pages">
    <?php if (isset($_GET['column']) === false): ?>
      <h2 class="main-title">Tous nos Produits</h2>
    <?php endif ?>
    <?php if (isset($_GET['column']) && $_GET['column'] !== 'categories'): ?>
      <h2 class="main-title"><?= getColumnName() ?></h2>
    <?php endif ?>
    <?php if (isset($paginate)): ?>
      <div class="pages-wrap">
        <?= $paginate ?>
      </div>
    <?php endif ?>
  </div>

  <div class="container-thumb">
    <?php while ($row = $thumbnailsData->fetch()): ?>
      <?php
      $ref = strtolower($row['ref']);
      $imgSrc = in_array("$ref.jpg", scandir('img')) === true ? $ref : 'defaut';
      $isSmall = strlen($row['title']) >= 30 ? "small" : null;
      ?>
      <div class="thumbnails">
        <div class="img-wrap">
          <img src="img/<?= $imgSrc ?>.jpg"/>
          <?php if ($row['public_price']): // vignettes?>
            <div class="price"><?= getFixedPrice($row['public_price']) ?>€</div>
          <?php endif ?>
        </div>
        <h3 class="<?= $isSmall ?>"><?= $row['title'] ?></h3>
        <div class='wrap-button'>
          <button class='button more' onclick="seeMore('<?= $ref ?>')">Détails</button>
          <?php if ($row['public_price']): ?>
            <a class='button buy' href='mon-panier/ajouter.php?ref=<?= $ref ?>'>Acheter</a>
          <?php endif ?>
        </div>
      </div>
    <?php endwhile ?>
  </div>

  <?php if (isset($paginate)): ?>
    <div class="container-pages">
      <div class="pages-wrap">
        <?= $paginate ?>
      </div>
    </div>
  <?php endif ?>
</main>

<?php require_once './template/footer.php'; ?>
