<?php

class PostController {

    public function index($params){
        try {
            $posts = Postagem::selPost($params['id']);

            $loader = new \Twig\Loader\FilesystemLoader('app/view');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('single.html');

            $parameters = array();
            $parameters['titulo'] = $posts->titulo;
            $parameters['conteudo'] = $posts->conteudo;
            $parameters['comentarios'] = $posts->comentarios;
            $conteudo = $template->render($parameters);
    
           echo $conteudo;
        } catch (Exception $e){
            echo $e->getMessage();
        }
    }
}