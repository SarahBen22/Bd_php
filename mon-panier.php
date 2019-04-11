<?php require_once './helpers/global.php'; ?>
<?php require_once './helpers/helpers.php'; ?>
<?php require_once './template/header.php'; ?>
<?php require_once './controllers/basket.php' ?>
<?php
function getBasketDetails(string $column, array $data) :?string {
  global $translation;

  if (isset($data["$column"])) {
    $label = $translation["$column"];
    $text = capitalize($data[$column]);

    return "<li>$label : <strong>$text</strong></li>";
  }

  return null;
}

function getTotalPrice(array $data): float {
  return array_reduce($data, function($acc, $curr) {
    $acc += ($curr['public_price'] * $curr['quantity']);
    return $acc;
  }, 0);
}
?>

<main class="main-basket">
  <div class="container-basket basket">
    <?php if ($products === []): ?>
      <hgroup class="title-wrap">
        <h2 class="title">Vous n'avez rien ajouté</h2>
        <h2 class="title small"> à votre panier pour le moment</h2>
      </hgroup>
      <a class="button-back-center" href="<?= sendBack() ?>">Retour</a>
    <?php else: ?>
      <?php foreach ($products as $key => $row): ?>
        <?php
        $ref = strtolower($row['ref']);
        $imgSrc = in_array("$ref.jpg", scandir('img')) === true ? $ref : 'defaut';
        ?>
        <div class="item-grid">
          <div class="img-wrap">
            <img class="img" src="img/<?= $imgSrc ?>.jpg"/>
            <div class="price"><?= getFixedPrice($row['public_price']) ?>€</div>
          </div>
          <div class="data-wrap">
            <div class="item-title"><?= capitalize($row['title']) ?></div>
            <ul>
                <?= getBasketDetails('author', $row) ?>
                <?= getBasketDetails('heroes', $row) ?>
                <?= getBasketDetails('categories', $row) ?>
                <?= getBasketDetails('editor', $row) ?>
            </ul>
          </div>
          <div class="total-wrap">
            <div class="item-button-wrap">
              <a class="button-less" href="./mon-panier/retirer.php?ref=<?= $ref ?>" class="button">-</a>
              <a class="button-remove" href="./mon-panier/supprimer.php?ref=<?= $ref ?>" class="button">Supprimer</a>
              <a class="button-more" href="./mon-panier/ajouter.php?ref=<?= $ref ?>" class="button">+</a>
            </div>
            <div class="item-quantity">Quantité : <strong><?= $row['quantity'] ?></strong></div>
            <div class="item-total">Total : <strong><?= getFixedPrice($row['public_price'] * $row['quantity']) ?>€</strong></div>
          </div>
        </div>
        <hr class="separator">
        <!-- <?= consoleLog($row) ?> -->
        <!-- <hr class="separator"> -->
      <?php endforeach ?>
      <div class="button-wrap">
        <a class="button-back" href="<?= sendBack() ?>">Retour</a>
        <a class="button-confirm" href="validation.php">Confirmer la Commande</a>
      </div>
      <div class="total-price">Total : <strong><?= getFixedPrice(getTotalPrice($products)) ?>€</strong></div>
    <?php endif ?>

  </div>
</main>

<?php require_once './template/footer.php'; ?>
