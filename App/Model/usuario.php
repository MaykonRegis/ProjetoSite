<?php
    use Database\Connection;
    class Usuario {
        private $idusuario;
        private $nome;
        private $email;
        private $senha;

        public function validarLogin(){
            //CONEXAO AO BANCO E BUSCA DO EMAIL
            $conn = Connection::getConn();
            $sql = "SELECT * FROM usuario WHERE email = :email";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':email', $this->email);
            $stmt->execute();
           //BUSCANDO TODOS OS DADOS DO BANCO
           if($stmt->rowCount()){
               $result = $stmt->fetch();

               if($result['senha'] === $this->senha){
                   //DADOS PARA EXIBIR NA DASHBOARD
                   //$result['idusuario'];
                $_SESSION['usr'] = array('idusuario' => $result['idusuario'], 'name_user' => $result['nome']);

                return true;
               }
           }

           //RETORNO DE ERRO
           throw new \Exception('login inválido');
        }

        

        public function cadastrarAcesso(){
            $conn = Connection::getConn();
            
            $inserir = "INSERT INTO usuario (nome, email, senha) VALUES (:nome, :email, :senha)";

            $cad = $conn->prepare($inserir);
            $cad->bindValue(':nome', $this->nome);
            $cad->bindValue(':email', $this->email);
            $cad->bindValue(':senha', $this->senha);
            $res = $cad->execute();
        }


        public function getNome(){
            return $this->nome;
        }
        public function setNome($nome){
            $this->nome = $nome;
        }

        public function getEmail(){
            return $this->email;
        }
        public function setEmail($email){
            $this->email = $email;
        }

        public function getSenha(){
            return $this->senha;
        }
        public function setSenha($senha){
            $this->senha = $senha;
        }
    }


?>