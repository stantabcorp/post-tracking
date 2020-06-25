<?php 

    namespace App\Utils;

    class Service{

        private $path;

        public function __construct($path)
        {
            $this->path = $path;
        }

        public function find($service){
            foreach(scandir($this->path) as $path){
                if($path == "." || $path == ".." || $path == "Services.php"){ continue; }
                include_once "{$this->path}/{$path}";
                $class = "\Services\\" . pathinfo($path, PATHINFO_FILENAME);
                $s = new $class;
                if($s->serviceName == $service){
                    return $s;
                }
            }
            return NULL;
        }

        public function track($code){
            foreach(scandir($this->path) as $path){
                if($path == "." || $path == ".." || $path == "Services.php"){ continue; }
                include_once "{$this->path}/{$path}";
                $class = "\Services\\" . pathinfo($path, PATHINFO_FILENAME);
                $s = new $class;
                if($s->serviceCode == "{$code[0]}{$code[1]}"){
                    if($s->serviceCountry == "{$code[11]}{$code[12]}"){
                        return $s->track($code);
                    }
                }
            }
            foreach(scandir($this->path) as $path){
                if($path == "." || $path == ".." || $path == "Services.php"){ continue; }
                include_once "{$this->path}/{$path}";
                $class = "\Services\\" . pathinfo($path, PATHINFO_FILENAME);
                $s = new $class;
                return $s->track($code);
            }
            return NULL;
        }

        public function listServices(){
            $services = [];
            foreach(scandir($this->path) as $path){
                if($path == "." || $path == ".." || $path == "Services.php"){ continue; }
                include_once "{$this->path}/{$path}";
                $class = "\Services\\" . pathinfo($path, PATHINFO_FILENAME);
                $s = new $class;
                $services[] = $s->serviceName;
            }
            return $services;
        }

    }