<?php

class AdminController {

    public function index(){
        

            $loader = new \Twig\Loader\FilesystemLoader('app/view');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('admin.html');
            $parameters = array();

            try {
                $objPostagem = Postagem::GetPostagemDB();
                $parameters['postagens']= $objPostagem; 
            } catch (Exception $e) {
                $parameters['ErrorMessage'] = "Não há nenhum cadastro encontrado";
            }
            
            $conteudo = $template->render($parameters);
            echo $conteudo;
            
        
    }
    public function create(){
        $loader = new \Twig\Loader\FilesystemLoader('app/view');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('create.html');

        $conteudo = $template->render();
        echo $conteudo;
    }
    
    public function insert(){
        try {
            Postagem::insert($_POST);
            echo '<script>alert("Publicação inserida com sucesso!");</script>';
            echo '<script>location.href="http://localhost:8000/?pagina=admin&metodo=insert&metodo=index"</script>';
        } catch (Exception $e) {
            echo '<script>alert("'.$e->getMessage().'");</script>';
            echo '<script>location.href="http://localhost:8000/?pagina=admin&metodo=insert&metodo=create"</script>';
        }
    }

    public function change($paramId){
        $loader = new \Twig\Loader\FilesystemLoader('app/view');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('update.html');

        $post = Postagem::selPost($paramId['id']);
        
        $parameters = array();
        $parameters['id'] = $post->id;
        $parameters['titulo'] = $post->titulo;
        $parameters['conteudo'] = $post->conteudo;
        $conteudo = $template->render($parameters);
        echo $conteudo;
    }

    public static function update(){
        try {
            Postagem::update($_POST);
            echo '<script>alert("Publicação alterada com sucesso!");</script>';
            echo '<script>location.href="http://localhost:8000/?pagina=admin&metodo=insert&metodo=index"</script>';
        } catch (Exception $e) {
            echo '<script>alert("'.$e->getMessage().'");</script>';
            echo '<script>location.href="http://localhost:8000/?pagina=admin&metodo=insert&metodo=change&id='.$_POST['id'].'"</script>';
        }
    }
    public static function delete($params){
        try {
            Postagem::delete($params);
            echo '<script>alert("Publicação excluida com sucesso!");</script>';
            echo '<script>location.href="http://localhost:8000/?pagina=admin&metodo=insert&metodo=index"</script>';
        } catch (\Throwable $th) {
            echo '<script>alert("'.$e->getMessage().'");</script>';
            echo '<script>location.href="http://localhost:8000/?pagina=admin&metodo=insert&metodo=index"</script>';
        }
    }
}