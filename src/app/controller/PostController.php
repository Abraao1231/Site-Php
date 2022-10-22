<?php

class PostController {

    public function index($params){
        try {
            $posts = Postagem::selPost($params['id']);

            $loader = new \Twig\Loader\FilesystemLoader('app/view');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('single.html');

            $parameters = array();
            $parameters['id'] = $posts->id;
            $parameters['titulo'] = $posts->titulo;
            $parameters['conteudo'] = $posts->conteudo;
            $parameters['comentarios'] = $posts->comentarios;
            $conteudo = $template->render($parameters);
    
           echo $conteudo;
        } catch (Exception $e){
            echo $e->getMessage();
        }
    }
    public static function addComment()
    {
        var_dump($_POST);

        try {
            Comentario::insert($_POST);
            header('Location: http://localhost:8000/?pagina=post&id='.$_POST['id']);
        } catch (Exception $e) {
            echo '<script>alert("'.$e->getMessage().'");</script>';
            echo '<script>location.href="http://localhost:8000/?pagina=post&id='.$_POST['id'].'"</script>';
        }
    }
}