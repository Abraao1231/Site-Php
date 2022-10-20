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
}