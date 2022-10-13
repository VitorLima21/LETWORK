<?php
/**
 * Classe que contém as funcionalidades de retornar todos os clientes, cadastro de clientes, 
 * login, sair do sistema e verificar se um cliente está logado.
 */

    class ClienteController {

       

        public function cadastrarCliente($dados) {
            $conexao = new Conexao();
            $conexao = $conexao->conexao();
            
            $stmt = $conexao->prepare('INSERT INTO cliente( cpf , nome, email, senha) VALUES(:cpf , :nome, :email, :senha);');
            $stmt->bindParam(':cpf', $dados['cpf']);
            $stmt->bindParam(':nome', $dados['nome']);
            $stmt->bindParam(':email',$dados['email']);
            $stmt->bindParam(':senha',  $dados['senha']);
            
            $result =  $stmt->execute();
            return $result;
        }

        public function login($email, $senha) {
            $conexao = new Conexao();
            $conexao = $conexao->conexao();  
            $stmt = $conexao->prepare("SELECT  cpf, email, senha, nome FROM cliente WHERE email = :email AND senha = :senha");
            $stmt->execute(array('email' => $email, 'senha' => $senha));
            // var_dump($stmt);
            // exit();
            if ($stmt->rowcount() > 0) {                
                $result = $stmt->fetch();
                // var_dump($result);
                // exit();
                $_SESSION['logged_in'] = true;
                $_SESSION['user_id'] = $result['idCliente'];
                $_SESSION['user_email'] = $result['email'];
                $_SESSION['user_cpf'] = $result['cpf'];
                $_SESSION['user_nome'] = $result['nome'];
                $_SESSION['user_dataNascimento'] = $result['dataNascimento'];
               
                
                return true;
            }else {
                return false;
            }
        }

        public function logout(){
            session_destroy();
        }

        public function isLoggedIn(){
            if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true){
                return true;
            }
            return false;
        }

    }

?>