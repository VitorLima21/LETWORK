<?php

class Conexao
{

  // private $usuario = 'root';
  // private $senha = '';

  private $db_name = "sistemaLET";
  private $db_host = "localhost";
  private $db_user = "root";
  private $db_pass = "";

  /**
   * Conecta com o MySQL usando PDO
   */
  public function conexao()
  {
    return new PDO("mysql:dbname=" . $this->db_name . ";host=" . $this->db_host, $this->db_user, $this->db_pass);
  //    new PDO('mysql:host=localhost;dbname=carrinhoCompras; charset=utf8', $this->usuario, $this->senha);
  echo 'conectado';
  }
}
// $db_name = "letwork";
// $db_host = "localhost";
// $db_user = "root";
// $db_pass = "";

// $conn = 

// // Habilitar erros PDO
// $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
