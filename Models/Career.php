<?php

namespace Models;

    class Career {

        private $careerId;
        private $description; //título que se entrega una vez completada
        private $active;

        public function __construct($careerId, $description, $active)
        {
                $this->careerId = $careerId;
                $this->description = $description;
                $this->active = $active;
        }
        
        
        public function getCareerId(){
                return $this->careerId;
        }

        public function setCareerId($careerId) {
                $this->careerId = $careerId;
        }

        
        public function getDescription() {
                return $this->description;
        }

      
        public function setDescription($description)
        {         $this->description = $description;
        }

        
        public function getActive() {
                return $this->active;
        }

       
        public function setActive($active) {
                $this->active = $active;
        }
    }


?>