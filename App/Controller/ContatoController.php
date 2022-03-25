<?php

    class ContatoController{
        public function index(){
            //return 'Olá';
            $loader = new \Twig\Loader\FilesystemLoader('App/View');
            $twig = new \Twig\Environment($loader, [
                'cache' => '/path/to/compilation_cache','auto_reload' => true
            ]);
            $template = $twig->load('contato.html');

            return $template->render();         
        }

        public function formulario(){
            try{
                $formualario = new Formulario;
                $formualario->setNome($_POST['nome']);
                $formualario->setEmail($_POST['email']);
                $formualario->setDescricao($_POST['descricao']);
                $formualario->enviarFormulario();
                echo '<script>alert("Envio efetuado com sucesso");</script>';
                header('Location: http://localhost/projetosite/contato');
            }catch(Exception $e){
                header('Location: http://localhost/projetosite/home');
            }
        }


    }

?>