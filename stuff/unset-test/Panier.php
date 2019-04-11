<?php
function consoleLog($arg) {
  echo '<pre>';
  print_r($arg);
  echo '<pre>';
}

class Panier {
  private $articles;

  public function __construct() {
    $this->articles = [];
  }

  public function addArticle(Article $article) {
    foreach ($this->articles as $key => $value) {
      if ($key == $article->getId()) {
        $this->articles[$key]["quantity"]++;
        return $this;
      }
    }

    $this->articles[$article->getId()] = [
        "article" => $article,
        "quantity" => 1
    ];

    return $this;
  }

  public function delArticle($id) {
    if (isset($this->articles[$id])) {
      unset($this->articles[$id]);
      return true;
    }

    return false;
  }

  public function getAll() {
    return $this->articles;
  }
}

class Article {
  private $id;
  private $name;

  public function __construct(int $id, string $name) {
    $this->id = $id;
    $this->name = $name;
  }

  public function getId() {
    return $this->id;
  }
}

?>
