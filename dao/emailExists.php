<?php

	require_once './db.php';
	
	require_once 'addCliente.php';
	require_once("models/Message.php");

	require_once("globals.php");
	require_once("db.php");
	require_once("dao/ClienteController.php");
	require_once("models/Message.php");
	require_once("models/Cliente.php");
 
  
	
	


Class Email{

	public function ValidaEmail($email){ 
	 
	    $email = $_POST['email'];
	 	 $cpf = $_POST['cpf'];
		
	 	$conexao = new Conexao();       
		
		$conexao = $conexao->conexao();
        $stmt = $conexao->prepare('SELECT * FROM cliente WHERE email = "'.$email.'"');
        $stmt->execute();
		
		$stmt2 = $conexao->prepare('SELECT * FROM cliente WHERE cpf = "'.$cpf.'"');
        $stmt2->execute();
       
        $count2 = $stmt2->rowCount();
		$count = $stmt->rowCount();
		
	    if($count > 0){

	        echo "
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=auth.php'>
				<script type=\"text/javascript\">
					alert(\"Email já existente, por favor digite outro!\");
				</script>
				";

	    }else if( $count2 > 0){

			echo "
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=auth.php'>
				<script type=\"text/javascript\">
					alert(\"Cpf já existente, por favor digite outro!\");
				</script>
				";
	       
		}else{
			
			// var_dump($count());
			// exit();
	    	addCliente($_POST);
			
	    }
	}}
?>