<?php

  if(empty($produto[4])) {
    $produto[4] = "branco";
  }

?>
<div class="card let-card">
  
  <div class="card-img-top" style="background-image: url('<?= $BASE_URL ?>img/imagem/<?= $produto[4] ?>')"></div>
  <div class="card-body">
  <p class="rating">Descrição: <?= $produto[2] ?></p>
  <p class="rating">Valor: <?= $produto[3] ?></p>
      <p class="rating"><?= $produto[1] ?></p>
   

    <a href="<?= $BASE_URL ?>./dao/addCarrinho.php?produto=<?= $produto[0]  ?>" class="btn btn-primary rate-btn">Adicionar</a>
    <a href="<?= $BASE_URL ?>./dao/addCarrinho.php?produto=<?= $produto[0]  ?>" class="btn btn-primary card-btn">Comprar</a>
  </div>
</div>