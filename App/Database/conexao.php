<?php
 namespace Database;
    abstract class Connection {
        private static $conn;

        public static function getConn(){
            if(!self::$conn){
                self::$conn = new \PDO('mysql: host=localhost; dbname=teste', 'root', '');
            }else {
                echo "Erro ao conectar ao banco de dados";
            }
            return self::$conn;
        }
    }
?>