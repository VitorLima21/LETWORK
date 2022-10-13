<?php
session_start();
include_once '../db.php';
include_once 'ClienteController.php';


$user = new ClienteController();

    $conexao = new Conexao();
    $conexao = $conexao->conexao();

    $stmt = $conexao->prepare('UPDATE carrinhodeproduto SET quantidade = :quantidade WHERE produto_idproduto = :idproduto ');
    $stmt->execute( array(
                    ':quantidade' => $_POST['quantidade'],
                    ':idproduto' => $_POST['idproduto']
                    )
                );
    $stmt = null;  


header('Location: ../carrinho.php'); 

?>