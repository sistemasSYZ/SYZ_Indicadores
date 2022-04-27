<?php

    // clase que me maneja la conexiona la base de datos

    class conexion {

        private $server;
        private $user;
        private $pasword;
        Private $database;
        private $port;
        private $conexion;


        function __construct(){

            $listado = $this->dataconexion();

            foreach ($listado as $key => $value) {

                $this->server = $value['server'];
                $this->user = $value['user'];
                $this->pasword = $value['pasword'];
                $this->database = $value['database'];
                $this->port = $value['port'];

            }
                try {
                 $this->conexion = new PDO("pgsql:host=$this->server;port=$this->port;dbname=$this->database", $this->user, $this->pasword);
                 $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
               
                } catch (Exception $e) {
                    echo "Ocurrió un error con la base de datos: " . $e->getMessage();
                    die();
                }
            
        }

        // trae los datos de conexion de el archivo config
        private function dataconexion(){

            $direccion = dirname(__FILE__);
            $jsondata = file_get_contents($direccion."/"."config");
            return json_decode($jsondata, true);

        }

        // convierte los datos en UTF8
        private function convertirUTF8($array){

            array_walk_recursive($array,function(&$item,$key){
                
                if(!mb_detect_encoding($item,'utf-8',true)){
                    $item = utf8_encode($item);
                }

            });
            return $array;

        }

        //Ejecuta sentencia SQL
        
        public function obtenerDatos($sqlstr){

            $consulta = $this->conexion->query($sqlstr);
            $results = $consulta->fetchAll(PDO::FETCH_OBJ);
            return $results;

        }

        public function obtenerMes($mesnum){

            switch ($mesnum){
                case "1":
                   $mes="ENERO";
                   break;
                case "2":
                    $mes="FEBRERO";
                    break;
                case "3":
                    $mes="MARZO";
                    break;
                case "4":
                    $mes="ABRIL";
                    break;
                case "5":
                    $mes="MAYO";
                    break;
                case "6":
                    $mes="JUNIO";
                    break;
                case "7":
                    $mes="JULIO";
                    break;
                case "8":
                    $mes="AGOSTO";
                    break;
                case "9":
                    $mes="SEPTIEMBRE";
                    break;
                case "10":
                    $mes="OCTUBRE";
                    break;
                case "11":
                    $mes="NOVIEMBRE";
                    break;
                case "12":
                    $mes="DICIEMBRE";
                    break;
             }
            
            return $mes;

        }

       

    }


?>