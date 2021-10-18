<?php

namespace Models;

    // ver que onda el tema de la herencia
    class Company extends User {
        private $name;
        private $id;
        private $area; //string, descripción al area que pertenece

      
        public function getName() {
                return $this->name;
        }

        
        public function setName($name) {
                $this->name = $name;
        }

        
        public function getId() {
                return $this->id;
        }

    
        public function setId($id) {
                $this->id = $id;
        }

        public function getArea(){
                return $this->area;
        }

     
        public function setArea($area) {
                $this->area = $area;
        }
    }

?>