<?php

    class DashboardController{
        public function index(){
            //return 'Olá';
            $loader = new \Twig\Loader\FilesystemLoader('App/View');
            $twig = new \Twig\Environment($loader, [
                'cache' => '/path/to/compilation_cache','auto_reload' => true
            ]);
            $template = $twig->load('dashboard.html');
            //EXIBINDO O NOME NA DASH
            $parameters['name_user'] = $_SESSION['usr']['name_user'];
            return $template->render($parameters);

          }

          public function logout(){
              unset($_SESSION['usr']);
              session_destroy();
              header('Location:http://localhost/projetosite/');
          }
     
    }

?>