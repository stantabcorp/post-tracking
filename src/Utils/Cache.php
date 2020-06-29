<?php 

    namespace App\Utils;

    class Cache{

        private $handler;
        private $method;

        const CACHE_TIME = 3600*2;

        public function __construct($method, $handler){
            $this->method = $method;
            $this->handler = $handler;
        }

        public function get($element){
            return json_decode($this->handler->get($element), true);
        }

        public function set($element, $value){
            $value = json_encode($value);
            if($this->method == "redis"){
                return $this->handler->set($element, $value, "ex", self::CACHE_TIME);
            }
            $this->handler->set($element, $value);
            $this->handler->save();
        }

        public function has($element){
            if($this->method == "redis"){
                return $this->handler->exists($element);
            }
            return $this->handler->has($element);
        }

        public function removeOlderElements(){
            if($this->method == "file"){
                return $this->handler->deleteOlderThan(\Carbon\CarbonInterval::seconds(self::CACHE_TIME));
            }
        }

    }