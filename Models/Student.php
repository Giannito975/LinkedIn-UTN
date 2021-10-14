<?php
namespace Models;

    class Student extends User {

        private $firstName; //String
        private $lastName; //String
        private $dni; //string
        private $fileNumber; //string
        private $gender; //genero
        private $birthDate; //atributo tipo Date (revisar)
        private $email;
        private $phoneNumber;
        private $isActive; //boolean
        private $id; //string
        private $role; //integer: 0 = admin, 1 = student, 2 = empresa.

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

        

       
        public function getFileNumber() {
                return $this->fileNumber;
        }

        public function setFileNumber($fileNumber) {
                $this->fileNumber = $fileNumber;
        }
    }


?>