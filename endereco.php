<?php
require_once("template/header.php");

require_once("globals.php");
require_once("db.php");
require_once("dao/ClienteController.php");
require_once("models/Message.php");
require_once("models/Cliente.php");

$message = new Message($BASE_URL);

$flassMessage = $message->getMessage();

$user = new ClienteController();
$result = $user->isLoggedIn();
$conn = new Conexao();
$conn = $conn->conexao();
$stmt = $conn->prepare('SELECT * FROM estado');
$stmt->execute();
$resultado_estados = $stmt->fetchAll();

$Uf = isset($_GET['search']) ? $_GET['search'] : 0;



$stmt = $conn->prepare('SELECT * FROM municipio WHERE estado_Uf = "'.$Uf.'" ORDER BY Nome');

$stmt->execute();
$resultado_cidades = $stmt->fetchAll();

foreach( $resultado_cidades as $row_cidade ) { 
  echo '<option value="'.$row_cidade['Id'].'">'.$row_cidade['Nome'].'</option>';
}



$cpf = $_SESSION["user_cpf"];
$stmt2 = $conn->prepare('
		SELECT produto.nome, produto.valor, produto.imagem, produto.idproduto, gerou.quantidade FROM produto 
		INNER JOIN
			(SELECT carrinhodeproduto.produto_idproduto, carrinhodeproduto.quantidade FROM carrinhodeproduto
				INNER JOIN produto ON carrinhodeproduto.produto_idproduto = produto.idproduto
				INNER JOIN carrinho ON carrinhodeproduto.carrinho_idcarrinho = carrinho.idcarrinho 
		        WHERE carrinho.cliente_cpf = "' . $cpf . '"
			GROUP BY carrinhodeproduto.produto_idproduto) as gerou 

		ON produto.idproduto = gerou.produto_idproduto
    	GROUP BY produto.nome;');

$total = 0;
$stmt2->execute();
$carrinho = $stmt2->fetchAll();

if ($result == false) {
  $message->setMessage("Faça login", "error", "index.php");
} else if (!isset($_GET['proximo'])) {
  header('Location: ./carrinho.php');
}


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
      <form method="post" action="./dao/insertFinalizado.php" class="colorlib-form">
        <div class="row">
          <div class="col-md-7">
            <?php
           
            foreach ($carrinho as $movie) :
              $count = $movie[1] * $movie[4];
              $total = $count + $total;
            endforeach; ?>
            <h2>Endereço para entrega</h2>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="country">Estado</label>
                  <div class="form-field">
                    <i class="icon icon-arrow-down3"></i>
                    <select class="form-control" name="id_estado" id="id_estado" required>
                      <option value=""> Selecione...</option>

                      <?php foreach ($resultado_estados as $row) {
                        echo '<option value="' . $row['Uf'] . '">' . $row['Nome'] . '</option>';
                      } ?>

                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="id_cidade">Municipio</label>
                  <div class="form-field">
                    <i class="icon icon-arrow-down3"></i>
                    <select class="form-control" name="id_cidade" id="id_cidade" required>

                      <option value="#id_cidade">Selecione...</option>
                    </select>
                  </div>

                  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
                  <script type="text/javascript">
                    $('#id_estado').change(function() {
                      var valor = document.getElementById("id_estado").value;
                      $.get("endereco.php?search=" + valor, function(data) {
                        $("#id_cidade").find("option").remove();
                        $('#id_cidade').append(data);
                      });
                    });
                  </script>
                  
                </div>
              </div>
            </div>

          </div>
          <div class="col-md-5">
            <div class="cart-detail">
              <h2>Total</h2>
              <ul>
                <?php
                $count = 0;
                $total = 0;
                foreach ($carrinho as $row) {
                  $count = $row[1] * $row[4];
                  $total = $count + $total;
                  echo '
										<li>
											<ul>
												<li><span>' . $row[4] . ' x ' . $row[0] . '</span> <span>R$ ' . number_format($row[1] * $row[4], 2, ",", ".") . '</span></li>
											</ul>
										</li>';
                }
                echo '<h2><span>TOTAL</span> <span>R$ ' . number_format($total, 2, ",", ".") . '</span></h2>';
                ?>
              </ul>
            </div>

            <div class="row">
              <div class="col-md-12">
                <p><input type="submit" style="background-color: green !important" class="btn btn-primary" value="Finalizar" name="enviar"></input></p>
                
              </div>
            </div>
          </div>
        </div>
      </form>
      <tbody>



        <?php


        ?>
      </tbody>
    </table>

    

  </div>
</div>
<?php
require_once("template/footer.php");
?>