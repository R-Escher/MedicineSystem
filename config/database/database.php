<?php

    $DB = new DB;
    $database = $DB::_conectaDB();
    
    class DB{   
        public static $database;
        public static $e;
        
        public static function _conectaDB(){
            try{
                //('mysql:host= IP OU LOCALHOST ;dbname= NOME DB ;charset=utf8mb4','USUARIO','SENHA')
                self::$database = new PDO('mysql:host=localhost;dbname=msystem_db1;charset=utf8mb4','root','');
                self::$database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $e = self::$e;
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
            return self::$database;
        }

        public function selectAll($from){
            $string = "SELECT * FROM ". $from;
            $query = self::$database->prepare($string);
            $query->execute();
            $rows = $query->fetchAll(PDO::FETCH_OBJ);
            return $rows;
        }

        public function selectAllWhere($from, $where, $what){
            $string = "SELECT * FROM " . $from . " WHERE " . $where . " = :what";
            $query = self::$database->prepare($string);
            $query->execute(array(":what => $what"));
            $rows = $query->fetchAll(PDO::FETCH_OBJ);
            return $rows;
        }

    }
?>