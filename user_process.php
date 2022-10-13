<?php

  require_once("globals.php");
  require_once("db.php");
  require_once("models/Cliente.php");
  require_once("models/Message.php");
  require_once("dao/ClienteController.php");

  $message = new Message($BASE_URL);

  $user = new ClienteController();
  $conexao = new Conexao();
  $conexao = $conexao->conexao();
  var_dump($_REQUEST);
  exit();
  // Resgata o tipo do formulário
  $type = filter_input(INPUT_POST, "type");

  // Atualizar usuário
  if($type === "update") {

    // Resgata dados do usuário
    

    // Receber dados do post
    $nome = filter_input(INPUT_POST, "nome");
    $cpf = filter_input(INPUT_POST, "cpf");
   
    $email = filter_input(INPUT_POST, "email");

    
    

    // Preencher os dados do usuário
    $userData->nome = $nome;
    $userData->cpf = $cpf;
    $userData->email = $email;
    

///Arrumar


  // Atualizar senha do usuário
  } else if($type === "changepassword") {

    // Receber dados do post
    $password = filter_input(INPUT_POST, "password");
    $confirmpassword = filter_input(INPUT_POST, "confirmpassword");

    // Resgata dados do usuário
    $userData = $userDao->verifyToken();
    
    $id = $userData->id;

    if($password == $confirmpassword) {

      // Criar um novo objeto de usuário
  
///Arrumar

    } else {
      $message->setMessage("As senhas não são iguais!", "error", "back");
    }

  } else {

    $message->setMessage("Informações inválidas!", "error", "index.php");

  }