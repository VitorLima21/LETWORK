<?php
  require_once("template/header.php");

  require_once("globals.php");
  require_once("db.php");
  require_once("dao/ClienteController.php");
  require_once("models/Message.php");
  require_once("models/Cliente.php");

  $cliente = new Cliente();
  $user = new ClienteController();
  $userData = $user->isLoggedIn();

  $fullName = $cliente->getNome($user);

  

?>
  <div id="main-container" class="container-fluid edit-profile-page">
    <div class="col-md-12">
      <form action="<?= $BASE_URL ?>user_process.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="type" value="update">
        <div class="row">
          <div class="col-md-4">
            <h1><?= $fullName ?></h1>
            <p class="page-description">Altere seus dados no formulário abaixo:</p>
            <div class="form-group">
              <label for="name">Nome:</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="Digite o seu nome" value="<?= $_SESSION['user_nome']  ?>">
            </div>
            <div class="form-group">
              <label for="lastname">CPF:</label>
              <input type="text" readonly class="form-control" id="cpf" name="cpf" placeholder="Digite o seu nome" value="<?= $_SESSION['user_cpf']  ?>">
            </div>
            <div class="form-group">
              <label for="email">E-mail:</label>
              <input type="text" readonly class="form-control disabled" id="email" name="email" placeholder="Digite o seu nome" value="<?= $_SESSION['user_email']  ?>">
            </div>
            <input type="submit" class="btn card-btn" value="Alterar">
          </div>
          <div class="col-md-4">
          <div class="form-group">
              <label for="email">Data Nascimento:</label>
              <input type="text"  class="form-control disabled" id="dataNascimento" name="dataNascimento" placeholder="Digite o sua data Nascimento" value="<?= $_SESSION['user_dataNascimento']  ?>">
            </div>
            
          </div>
        </div>
      </form>
      <div class="row" id="change-password-container">
        <div class="col-md-4">
          <h2>Alterar a senha:</h2>
          <p class="page-description">Digite a nova senha e confirme, para alterar sua senha:</p>
          <form action="<?= $BASE_URL ?>user_process.php" method="POST">
            <input type="hidden" name="type" value="changepassword">
            <div class="form-group">
              <label for="password">Senha:</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="Digite a sua nova senha">
            </div>
            <div class="form-group">
              <label for="confirmpassword">Confirmação de senha:</label>
              <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" placeholder="Confirme a sua nova senha">
            </div>
            <input type="submit" class="btn card-btn" value="Alterar Senha">
          </form>
        </div>
      </div>
    </div>
  </div>
<?php
  require_once("template/footer.php");
?>