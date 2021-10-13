<?php
namespace Model;

    class Student extends User {

        private $firstName; //String
        private $lastName; //String
        private $dni; //string
        private $id; //string

        //Averiguar cómo hacemos para pasarle por parámetro el id de User, siendo clase padre de Student, que también tiene su propio id.
        public function __construct($firstName, $lastName, $dni, $id, $userName, $password, $email){

        }

        
        public function getFirstName() {
                return $this->firstName;
        }

      
        public function setFirstName($firstName){
                $this->firstName = $firstName;
        }

        
        public function getLastName() {
                return $this->lastName;
        }

        
        public function setLastName($lastName) {
                $this->lastName = $lastName;
        }

        public function getDni(){
                return $this->dni;
        }

       
        public function setDni($dni){
                $this->dni = $dni;
        }

       
        public function getId() {
                return $this->id;
        }

        
        public function setId($id){
                $this->id = $id;
        }
    }


?>