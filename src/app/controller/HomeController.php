<?php

class HomeController {

    public function index(){
        try {
            $posts = Postagem::GetPostagemDB();

            $loader = new \Twig\Loader\FilesystemLoader('app/view');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('home.html');

            $parameters = array();
            $parameters['postagens'] = $posts;

            $conteudo = $template->render($parameters);
           echo $conteudo;
        } catch (Exception $e){
            echo $e->getMessage();
        }
    }
}