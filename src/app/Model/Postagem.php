<?php
class Postagem {
    public static function GetPostagemDB(){

        $con = Connection::getConn();
        try {
        $sql = "SELECT * FROM  postagem ORDER BY id DESC";
        $sql = $con->prepare($sql);
        $sql->execute();
        } catch (Exception $e) {
            throw new Exception('Erro no banco de dados');
        }
        $resultado = array();

        while($row = $sql->fetchObject('Postagem')){
            $resultado[] = $row;
        }
        if (!$resultado){
            throw new Exception('Não foi encontrado registro no banco');
        }
        return $resultado;
    }

    public static function selPost($idPost)
    {
        $con = Connection::getConn();

        $sql = "SELECT * FROM postagem WHERE id = :id";
        $sql = $con->prepare($sql);
        $sql->bindValue(':id', $idPost, PDO::PARAM_INT);
        $sql->execute();

        $resultado = $sql->fetchObject('Postagem');
        if (!$resultado) {
            throw new Exception("Não foi encontrado nenhum registro no banco");	
        } else {
            $resultado->comentarios = Comentario::selecComment($resultado->id);
        }

        return $resultado;
    }
    public static function insert($dadosPost){
        if(empty($dadosPost['titulo']) || empty($dadosPost['conteudo'])){
            throw new Exception("Preencha todos os campos");
            return false;
        }
        $conn = Connection::getConn();
        $sql = $conn->prepare( 'INSERT INTO postagem (titulo, conteudo) VALUES (:tit, :cont)');
        $sql->bindvalue(':tit', $dadosPost['titulo']);
        $sql->bindvalue(':cont', $dadosPost['conteudo']);
        $res = $sql->execute();
        if($res == 0){
            throw new Exception("Falha na inserção da publicação", 1);
            }
        }
    
     public static function update($params){
        $conn = Connection::getConn();
        $sql = "UPDATE postagem SET titulo = :tit, conteudo = :cont WHERE id = :id";
        $sql = $conn->prepare($sql);
        $sql->bindvalue(':tit', $params['titulo']);
        $sql->bindvalue(':cont', $params['conteudo']);
        $sql->bindvalue(':id', $params['id']);
        $resultado = $sql->execute();

        if($resultado == 0){
            throw new Exception("Falha ao alterar a publicação");

            return false;
        }
        return true;
    }
    public static function delete($params){
        $conn = Connection::getConn();
        $sql = "DELETE FROM postagem WHERE  id = :id";
        $sql = $conn->prepare($sql);
        $sql->bindValue(':id', $params['id']);
        $resultado = $sql->execute();

        if ($resultado == 0){
            throw new Exception("Não foi possivel deletar a publicação");
            return false;
        }    
        return true;
        
    }
}
