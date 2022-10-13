<?php
  require_once("template/header.php");
  require_once("db.php");

  require_once("dao/ClienteController.php");
  require_once("dao/ProdutoController.php");

  // DAO dos filmes
  $user = new ClienteController();

	$result = $user->isLoggedIn();
  $produtos = ProdutoController::allProdutos();

  // var_dump($produtos);

?>
  <div id="main-container" class="container-fluid">
    <h2 class="section-title">Produtos novos</h2>
    <p class="section-description">Veja os Produtos novos.</p>
    <div class="letworks-container">
      <?php foreach($produtos as $produto): ?>
        <?php require("template/card.php"); ?>
      <?php endforeach; ?>
      <?php if(count($produtos) === 0): ?>
        <p class="empty-list">Ainda não há produtos cadastrados!</p>
      <?php endif; ?>
    </div>
    
    </div>
  </div>
<?php
  require_once("template/footer.php");
?>