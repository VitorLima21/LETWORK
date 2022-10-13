	<?php

		include_once './db.php';
		include_once 'ClienteController.php';

		function addCliente($dados){
			$cliente = new ClienteController();
			$result = $cliente->cadastrarCliente($_POST);

			if ($result){
				echo "
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=auth.php'>
				<script type=\"text/javascript\">
					alert(\"Cadastrado com sucesso\");
				</script>
				";
			}else{
	    		echo "
				<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=auth.php'>
				<script type=\"text/javascript\">
					alert(\"Erro ao Cadastrada\");
				</script>
				";
			}
		}
	?>