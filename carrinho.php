<?php
require_once("template/header.php");

// Verifica se usuário está autenticado
// require_once("models/User.php");
// require_once("dao/UserDAO.php");
// require_once("dao/ProdutoDAO.php");

require_once("globals.php");
require_once("db.php");
require_once("dao/ClienteController.php");
require_once("models/Message.php");
require_once("models/Cliente.php");

$message = new Message($BASE_URL);

$flassMessage = $message->getMessage();

$user = new ClienteController();
$userData = $user->isLoggedIn();

$conn = new Conexao();
$conn = $conn->conexao();



$stmt4 = $conn->prepare('
		SELECT * FROM carrinhodeproduto;');
$stmt4->execute();
$count = 0;
$count = $stmt4->rowCount();

if ($userData == false) {
  $message->setMessage("Faça login", "error", "index.php");
}

$cpf = $_SESSION["user_cpf"];
$stmt = $conn->prepare('
		SELECT produto.nome, produto.valor, produto.imagem, produto.idproduto, gerou.quantidade FROM produto 

		INNER JOIN
			(SELECT carrinhodeproduto.produto_idproduto, carrinhodeproduto.quantidade FROM carrinhodeproduto
				INNER JOIN produto ON carrinhodeproduto.produto_idproduto = idproduto
				INNER JOIN carrinho ON carrinhodeproduto.carrinho_idcarrinho = carrinho.idcarrinho 
		        WHERE carrinho.cliente_cpf = "' . $cpf . '"
			GROUP BY carrinhodeproduto.produto_idproduto) as gerou 

		ON produto.idproduto = gerou.produto_idproduto
    	GROUP BY produto.nome;');

$total = 0;
$stmt->execute();

$carrinho = $stmt->fetchAll();
// var_dump($carrinho);

?>
<div id="main-container" class="container-fluid">
  <h2 class="section-title">Meu carrinho</h2>
  <p class="section-description">Adicione ou atualize as informações dos filmes que você enviou</p>
  <div class="col-md-12" id="add-let-container">
    <a href="<?= $BASE_URL ?>index.php" class="btn card-btn">
      <i class="fas fa-plus"></i> Adicionar Produtos
    </a>
  </div>
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
         $count = 0;
         $total = 0;
        foreach ($carrinho as $movie) : ?>
          <tr>

            <td scope="row"><?= $movie[0] ?></td>
            <td scope="row"><?= number_format($movie[1] ,2,",","."); ?></td>
            <td>

              <form action="<?= $BASE_URL ?>/dao/updateQtd.php" method="POST">
                <input type="text" name=quantidade id=quantidade value="<?= $movie[4] ?>">
                <input type="hidden" name="idproduto" id="idproduto" value="<?= $movie[3] ?>">
                <button type="submit" class="edit-btn">
                  <i class="far fa-edit"></i> Alterar Quantidade
                </button>
              </form>
            </td>
            <td>
            <?php number_format($movie[1],2);
            ?>
            
            </td>
            <td class="actions-row">

              <form action="<?= $BASE_URL ?>/dao/delete.php?produto=<?= $movie[3] ?>" method="POST">

                <button type="submit" class="delete-btn">
                  <i class="fas fa-times"></i> Excluir Produto
                </button>
              </form>
            </td>
          </tr>
        <?php 
        $count = $movie[1]*$movie[4];
        $total = $count + $total;
      endforeach; 
      
      ?>
      </tbody>
    </table>

    <div class="col-md-12" id="add-let-container">
    <a href="<?= $BASE_URL ?>endereco.php?proximo=true&carrinho=true" class="btn card-btn">
       <h2>Valor Total: <?php echo number_format($total,2,",","."); ?></h2>
       <h3>Finaliza Compra</h3>
    </a>
  </div>
      
  </div>
</div>
<?php
require_once("template/footer.php");
?>