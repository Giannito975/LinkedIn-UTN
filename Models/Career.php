<?php

namespace Models;

    class Career {

        private $id;
        private $name;
        private $title; //título que se entrega una vez completada
        private $status;

        public function __construct()
        {
                
        }
        
        
        public function getId(){
                return $this->id;
        }

        public function setId($id) {
                $this->id = $id;
        }

        
        public function getName() {
                return $this->name;
        }

        public function setName($name){
                $this->name = $name;
        }

        
        public function getTitle() {
                return $this->title;
        }

      
        public function setTitle($title)
        {         $this->title = $title;
        }

        
        public function getStatus() {
                return $this->status;
        }

       
        public function setStatus($status) {
                $this->status = $status;
        }
    }


?>