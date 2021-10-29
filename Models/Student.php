<?php
namespace Models;

    class Student extends User {

        private $firstName; //String
        private $lastName; //String
        private $dni; //string
        private $fileNumber; //string
        private $gender; //genero
        private $birthDate; //atributo tipo Date (revisar)
        private $phoneNumber;
        private $career; 
        private $idStudent; //string

        public function getCareer() {
                return $this->career;
        }

      
        public function setCareer($career){
                $this->career = $career;
        }

        public function getPhoneNumber() {
                return $this->phoneNumber;
        }
      
        public function setPhoneNumber($phoneNumber){
                $this->phoneNumber = $phoneNumber;
        }        
        
        public function getBirthDate() {
                return $this->birthDate;
        }
      
        public function setBirthDate($birthDate){
                $this->birthDate = $birthDate;
        }

        public function getGender() {
                return $this->gender;
        }
      
        public function setGender($gender){
                $this->gender = $gender;
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
       
        public function getidStudent() {
                return $this->idStudent;
        }
        
        public function setidStudent($idStudent){
                $this->idStudent = $idStudent;
        }
               
        public function getFileNumber() {
                return $this->fileNumber;
        }

        public function setFileNumber($fileNumber) {
                $this->fileNumber = $fileNumber;
        }
    }


?>