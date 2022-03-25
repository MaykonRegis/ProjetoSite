<?php

    class SobreController{
        public function index(){
            //return 'Olá';
            $loader = new \Twig\Loader\FilesystemLoader('App/View');
            $twig = new \Twig\Environment($loader, [
                'cache' => '/path/to/compilation_cache','auto_reload' => true
            ]);
            $template = $twig->load('sobre.html');

            return $template->render();
        }
    }

?>