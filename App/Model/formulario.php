<?php
    use Database\Connection;
    class Formulario{
        private $nome;
        private $email;
        private $descricao;

        public function enviarFormulario(){
            $conn = Connection::getConn();

            $insert = "INSERT INTO formulario (nome, email, descricao) VALUES (:nome, :email, :descricao)";

            $formu = $conn->prepare($insert);
            $formu->bindValue(':nome', $this->nome);
            $formu->bindValue(':email', $this->email);
            $formu->bindValue(':descricao', $this->descricao);
            $enviar = $formu->execute();
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

        public function getDescricao(){
            return $this->descricao;
        }
        public function setDescricao($descricao){
            $this->descricao = $descricao;
        }
    }


?>