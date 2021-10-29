<?php

namespace Models;

    abstract class User {

        private $active;
        private $password;
        private $email;

        public function getActive()
        {
                return $this->active;
        }

    
        public function setActive($active){
                $this->active = $active;

                return $this;
        }

        
        public function getPassword() {
                return $this->password;
        }

       
        public function setPassword($password) {
                $this->password = $password;

                return $this;
        }

      
        public function getEmail(){
                return $this->email;
        }

     
        public function setEmail($email){
                $this->email = $email;

                return $this;
        }
    }

?>