<?php
/**
 * Arquivo que retorna todos os produtos disponiveis do db
 */
include_once './db.php';

class ProdutoController {

    public static function allProdutos(){
        $produtos = [];
        $conexao = new Conexao();
        $conexao = $conexao->conexao();
        $stmt = $conexao->query("SELECT * FROM produto;");
        $stmt->execute();
        $produtos = $stmt->fetchAll();
        $stmt = null;
        return $produtos;
    }

}
