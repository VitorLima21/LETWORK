<?php
require_once("template/header.php");


require_once("dao/ClienteController.php");
require_once("dao/ProdutoController.php");
require_once("globals.php");
require_once("db.php");
require_once("models/Message.php");
require_once("models/Cliente.php");
// DAO dos filmes
$user = new ClienteController();
$result = $user->isLoggedIn();

// var_dump($_REQUEST);

$message = new Message($BASE_URL);
$q = isset($_GET['q']) ? $_GET['q'] : "";


// var_dump($q);
$conexao = new Conexao();
$conexao = $conexao->conexao();
$stmt = $conexao->query("SELECT * FROM produto  WHERE nome LIKE '$q%'");
// var_dump($stmt);
// exit();

$stmt->execute();

$produtos = $stmt->fetchAll();


// var_dump($produtos);       

?>
<div id="main-container" class="container-fluid">
  <h2 class="section-title" id="search-title">Você está buscando por: <span id="search-result"><?= $q ?></span></h2>
  <p class="section-description">Resultados de busca retornados com base na sua pesquisa.</p>
  <div class="letworks-container">
    <?php foreach ($produtos as $produto) : ?>
      <?php require("template/card.php"); ?>
    <?php endforeach; ?>
    <?php if (count($produtos) === 0) : ?>
      <p class="empty-list">Não há produtos para esta busca, <a href="<?= $BASE_URL ?>" class="back-link">voltar</a>.</p>
    <?php endif; ?>
  </div>
</div>
<?php
require_once("template/footer.php");
?>