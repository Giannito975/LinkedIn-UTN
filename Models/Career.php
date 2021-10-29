<?php

namespace Models;

    class Career {

        private $idCareer;
        private $description;
        private $active;
        
        
        public function getIdCareer(){
                return $this->idCareer;
        }

        public function setIdCareer($idCareer){
                $this->idCareer = $idCareer;
        }
        
        public function getDescription() {
                return $this->description;
        }

        public function setDescription($description){
                $this->description = $description;
        }
        
        public function getActive() {
                return $this->active;
        }
      
        public function setActive($active){         
                $this->active = $active;
        }
    }


?>