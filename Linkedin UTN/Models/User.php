<?php

namespace Models;

    abstract class User {

        private $userName;
        private $password;
        private $email;

        public function getUserName()
        {
                return $this->userName;
        }

    
        public function setUserName($userName){
                $this->userName = $userName;

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