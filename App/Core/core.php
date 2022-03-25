<?php
    // ----------------PASSO 1-----------------------
    //1-CRIAR O CORE E SUA CLASSE
    //2-CRIAR DOIS METODOS UM CONSTRUTOR E OUTRO START
    //3-FAZER A INSTACIAÇÃO DA CLASSE CORE 
    //4-FAZER A CHAMADA DO METODO START COM O GET DENTRO DELE 
    //5-COLOCAR O ARQUIVO DA URL AMIGAVEL DENTRO DO PROJETO
    //6 DAR UM VARDAMPU NO REQUEST
    //7-COM A FUNCAO EXPLODE EU QUEBRO A BARRA E TRANSFORMO NUM ARRAY

    //-------------------PASSO 2 ---------------------------
    //8-DIGO QUE A CONTROLLER VAI SER IGUAL A URL NA POSICAO 0
    //9-COLOCO UM ARRAY SHIFT PARA APAGAR A POSICAO
    //10-CRIAR OS ATRIBUTOS CONTROLLER E METODO
    //11-CRIAR OUTRO ATRIBUTO PARAMS
    //12-DAR NOVAMENTE OUTRO ARRAY SHIFT
    //13-DAR UM VARDAMPU EM TODAS AS ESSEÇOES

    //-------------------PASSO 3 ----------------------------------
    //14-CRIAR UM IF PARA VERIFICAR SE TEM ALGUMA INFORMACAO NA URL
    //15-DEFINIR O METHODO DE RETORNO E O CONTROLER DE RETORNO
    //16-NO PARAMS DEIFNIR UM VALOR PADRAO 
    //17-UTILIZANDO A FUNCAO CALL-USER-FUNCT PARA RETORNA A PAGINA
    
    //-----------------------PASSO 4----------------------------------
    //19-COLOCAR UM ISSET NO PRIMEIRO IF
    //20-COLOCAR O RETURN NO CALL USE
    //21-O ECHO COLOCA NA INDEX NO CORE->START
    //22-COLOCAR OUTRO IF PRO METHOD E PARAMS
    //23-NO ATRIBUTO METHOD COLOCAR UM VALOR PADRAO COMO INDEX


    Class Core {
        private $url;
        private $controller;
        private $method = 'index';
        private $params = array();

        private $usuario;
        //CRIAR OUTRO ATRIBUTO DO MSG DE ERROR
        private $error;

        public function __construct(){
            $this->usuario = $_SESSION['usr'] ?? null;

            //MSG DE ERROR
            $this->error = $_SESSION['msg_error'] ?? null; 

            if(isset($this->error)){
                if($this->error['count'] === 0){
                    $_SESSION['msg_error']['count']++;
                    //var_dump($this->error);
                }else {
                    unset($_SESSION['msg_error']);
                }
            }
        }

        public function start($request){
            if(isset($request['url'])){
                //var_dump($request);
                $this->url = explode('/', $request['url']); // PARA QUEBRAR E TRANFORMA NUM ARRAY
                //var_dump($this->url);

                $this->controller = ucfirst($this->url[0]).'Controller'; // PARA PEGAR SOMENTE A PRIMEIRA PAGINA OU METHODO
                array_shift($this->url);// ´PARA APAGAR A PRIMEIRA POSICAO DA VARIAVEL 

                //COMANDO PARA 
                if(isset($this->url[0]) && $this->url != ''){
                    $this->method = $this->url[0]; 
                    array_shift($this->url); // PARA APAGAR NOVAMENTE A PRIMEIRA POSICAO 

                    if(isset($this->url[0]) && $this->url != ''){
                        $this->params = $this->url; // PARA OQUE VINHER DEPOIS DAS BARRA NA URL
                    }
                }
            }
            
            if($this->usuario){
                $pg_permision = ['DashboardController', 'ContatoController', 'HomeController', 'SobreController', 'ContatoController'];
                if(!isset($this->controller) || !in_array($this->controller, $pg_permision)){
                    $this->controller = 'HomeController';
                    $this->method = 'index';
                }
            }else {
                $pg_permision = ['LoginController', 'CadastroController'];
                if(!isset($this->controller) || !in_array($this->controller, $pg_permision)){
                    $this->controller = 'HomeController';
                    $this->method = 'index';
                }
            }
            //}else {
               // $this->controller = 'HomeController';
               // $this->method = 'index';
           // }
            //var_dump($this->controller, $this->method, $this->params);
            return call_user_func(array(new $this->controller, $this->method), $this->params);
        }
    }

?>