<?php

	session_start();
	include_once '../db.php';
	include_once 'ClienteController.php';

	$user = new ClienteController();

    $conexao = new Conexao();
    $conexao = $conexao->conexao();
    
    var_dump($_GET['produto']);
    
    // exit();
    $stmt = $conexao->prepare('DELETE FROM carrinhodeproduto WHERE produto_idproduto = :idproduto ');
    $stmt->execute( array(
                    ':idproduto' => $_GET['produto']
                    )
                );
    $stmt = null;  


    header('Location:../carrinho.php'); 

?>