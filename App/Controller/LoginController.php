<?php

    class LoginController{
        public function index(){
            //return 'Olá';
            $loader = new \Twig\Loader\FilesystemLoader('App/View');
            $twig = new \Twig\Environment($loader, [
                'cache' => '/path/to/compilation_cache','auto_reload' => true
            ]);
            $template = $twig->load('login.html');
            //CRIAR UMA VARIAVEL
            //COLOCAR A VARIAVEL NO RENDER
            $parameters['error'] = $_SESSION['msg_error'] ?? null;
            return $template->render($parameters);

          }

          public function logar(){
            try{
                $user = new Usuario;
                $user->setEmail($_POST['email']);
                $user->setSenha($_POST['senha']);
                $user->validarLogin();
                header('Location: http://localhost/projetosite/dashboard');
            }catch(\Exception $e){
                //MSG DE ERROR
                $_SESSION['msg_error'] = array('smg' => $e->getMessage(), 'count' => 0);
                header('Location: http://localhost/projetosite/login');
            }

        }
    }

?>