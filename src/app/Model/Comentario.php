<?php

class Comentario{
    public static function selecComment($id){
        $con = Connection::getConn();

        $sql = "SELECT * FROM comentario WHERE id_postagem = :id";
        $sql = $con->prepare($sql);
        $sql->bindValue(':id', $id, PDO::PARAM_INT);
        $sql->execute();
        while ($row = $sql->fetchObject('Comentario')) {
            $resultado[] = $row;
        }
         
        return $resultado;
    }

    public static function insert($dadosPost)
    {
        try {
            $conn = Connection::getConn();
            $sql = $conn->prepare('INSERT INTO comentario (nome, mensagem, id_postagem) VALUES (:nome, :msg, :id)');
            $sql->bindvalue(':nome', $dadosPost['nome']);
            $sql->bindvalue(':msg', $dadosPost['msg']);
            $sql->bindvalue(':id', $dadosPost['id']);
            $sql->execute();
        
            
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
       

        if($sql->rowCount()){
            return true;
        } 
            throw new Exception("Falha na inserção do comentario");  
        }
    

    }