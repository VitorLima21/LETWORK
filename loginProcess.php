<?php

  require_once("globals.php");
  require_once("db.php");
  // require_once("models/User.php");
  require_once("models/Message.php");
  require_once("dao/ClienteController.php");
  require_once("dao/emailExists.php");

  $userClienteController = new ClienteController();
  $message = new Message($BASE_URL);

  $validaEmail = new Email();
  // var_dump($_REQUEST);
  // exit;
  // Resgata o tipo do formulário
  $type = filter_input(INPUT_POST, "type");

  // Verificação do tipo de formulário
  if($type === "register") {

    $nome = filter_input(INPUT_POST, "nome");    
    $email = filter_input(INPUT_POST, "email");
    $password = filter_input(INPUT_POST, "senha");
    $confirmpassword = filter_input(INPUT_POST, "confirmpassword");

    // Verificação de dados mínimos 
    if($nome  && $email && $password) {

      // Verificar se as senhas batem
      if($password === $confirmpassword) {

        // Verificar se o e-mail já está cadastrado no sistema
        $validaEmail->ValidaEmail($email);
        // if($validaEmail->ValidaEmail($email) === false) {
///
          
        //   $message->setMessage("Usuário  cadastrado", "success", "index.php");
        // } else {
          
        //   // Enviar uma msg de erro, usuário já existe
        //   $message->setMessage("Usuário já cadastrado, tente outro e-mail.", "error", "back");

        // }

      } else {

        // Enviar uma msg de erro, de senhas não batem
        $message->setMessage("As senhas não são iguais.", "error", "back");

      }

    } else {

      // Enviar uma msg de erro, de dados faltantes
      $message->setMessage("Por favor, preencha todos os campos.", "error", "back");

    }

  } else if($type === "login") {

    // var_dump($_REQUEST);
    // exit();
    $email = filter_input(INPUT_POST, "email");
    $password = filter_input(INPUT_POST, "password");

    // Tenta autenticar usuário
    if($userClienteController->login($email, $password)) {

      $message->setMessage("Seja bem-vindo!", "success", "index.php");

    // Redireciona o usuário, caso não conseguir autenticar
    } else {

      $message->setMessage("Usuário e/ou senha incorretos.", "error", "back");

    }

  } else {

    $message->setMessage("Informações inválidas!", "error", "index.php");

  }