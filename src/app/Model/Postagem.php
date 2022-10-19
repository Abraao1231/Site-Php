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

}