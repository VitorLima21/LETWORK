<?php
require_once("template/header.php");

// Verifica se usuário está autenticado
// require_once("models/User.php");
// require_once("dao/UserDAO.php");
// require_once("dao/ProdutoDAO.php");


require_once("db.php");
require_once("dao/ClienteController.php");
require_once("dao/ListController.php");
require_once("models/Message.php");


$message = new Message($BASE_URL);

$flassMessage = $message->getMessage();

$user = new ClienteController();
$userData = $user->isLoggedIn();

$conn = new Conexao();
$conn = $conn->conexao();



if ($userData == false) {
  $message->setMessage("Faça login", "error", "index.php");
}

$cpf = $_SESSION["user_cpf"];

$pCarrinho = ListController::selectList();

// var_dump($pCarrinho);

?>
<div id="main-container" class="container-fluid">
  <h2 class="section-title">Meus Pedido</h2>
  <p class="section-description">Pedidos Concluidos</p>
  
  <div class="col-md-12" id="letworks-dashboard">
    <table class="table">
      <thead>
        <th scope="col">Produto</th>
        <th scope="col">Valor</th>
        <th scope="col">Quantidade</th>
       
        <!-- <th scope="col" class="actions-column">Remover Pr</th> -->
      </thead>
      <tbody>
     
        <?php 
         
        foreach ($pCarrinho as $movie) : ?>
          <tr>

            <td scope="row"><?= $movie[0] ?></td>
            <td scope="row"><?= number_format($movie[1] ,2,",","."); ?></td>
            <td scope="row"><?= $movie[3]?></td>
            <td scope="row"><?= $movie[3]?></td>
            
            
          </tr>
        <?php 
        
      endforeach; 
      
      ?>
      </tbody>
    </table>

    
      
  </div>
</div>
<?php
require_once("template/footer.php");
?>