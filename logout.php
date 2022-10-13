<?php

  require_once("template/header.php");
  // require_once("models/Message.php");
  $userData = new ClienteController();
  // $message = new Message($BASE_URL);
 

  if($userData) {
    $userData->logout();
    $message->setMessage("Você fez o logout com sucesso!", "success", "index.php");
  }