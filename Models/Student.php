<?php
namespace Models;

class Student{

    private $firstName; //String
    private $lastName; //String
    private $dni; //string
    private $fileNumber; //string
    private $gender; //genero
    private $birthDate; //atributo tipo Date (revisar)
    private $phoneNumber;
    private $idCareer; 
    private $idStudent; //string
    private $active;
    private $email;
    private $password;

    public function __construct($idStudent, $idCareer, $firstName, $lastName, $dni, $fileNumber, $gender, $birthdate, $phoneNumber, $active, $email, $password)
    {
            $this->idStudent = $idStudent;
            $this->idCareer = $idCareer;
            $this->firstName = $firstName;
            $this->lastName = $lastName;
            $this->dni = $dni;
            $this->fileNumber = $fileNumber;
            $this->gender = $gender;
            $this->birthDate = $birthdate;
            $this->phoneNumber = $phoneNumber;
            $this->active = $active;
            $this->email = $email;
            $this->password = $password;
    }

        public function getPassword() {
                return $this->password;
        }

        public function setPassword($password){
                $this->password = $password;
        }

        public function getEmail() {
                return $this->email;
        }

        public function setEmail($email){
                $this->email = $email;
        }

        public function getActive() {
                return $this->active;
        }


        public function setActive($active){
                $this->active = $active;
        }

        public function getIdCareer() {
                return $this->idCareer;
        }

  
        public function setIdCareer($idCareer){
                $this->idCareer = $idCareer;
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
        
        public function getIdStudent() {
                return $this->idStudent;
        }
        
        public function setIdStudent($idStudent){
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