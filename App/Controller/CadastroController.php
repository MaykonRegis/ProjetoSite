<?php
    
    class CadastroController{
        public function index(){
            //return 'Olá';
            $loader = new \Twig\Loader\FilesystemLoader('App/View');
            $twig = new \Twig\Environment($loader,[
                'cache' => '/path/to/compilation_cache','auto_reload' => true
            ]);
            $template = $twig->load('Cadastro.html');

            return $template->render();

            
        }

        public function cadastrar(){
            try{
                $usuario = new Usuario;
                $usuario->setNome($_POST['nome']);
                $usuario->setEmail($_POST['email']);
                $usuario->setSenha($_POST['senha']);
                $usuario->cadastrarAcesso();
                echo '<script>alert("Cadastro efetuado com sucesso");</script>';
                //header('Location: http://localhost/projetosite/login');
                
                //$_SESSION['msg'] = "<P style='color: green;'>USUARIO CADASTRADO COM SUCESSO</P>";
                //echo '<script>Location.href="http://localhost/projetosite/cadastro"</script>'; 
                //header("Location: http://localhost/projetosite/cadastro");
            }catch(Exception $e){
                //$_SESSION['msg_error'] = array('msg' => $e->getMessage(), 'count' => 0);  // MSG DE ERROR
                header('Location: http://localhost/projetosite/cadastro');
            }
       
        }
    }

?>