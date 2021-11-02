<?php
    namespace Controllers;

    use DAO\StudentDAO as StudentDAO;
    use Models\Student;

    class StudentController
    {
        private $studentDAO;

        public function __construct()
        {
            $this->studentDAO = new StudentDAO();
        }

        //hablar con dante san sobre si es provisional o no
        public function ShowProfileView(){
            require_once(VIEWS_PATH."student-profile.php");
        }

        public function ShowJobOfferView(){
            require_once(VIEWS_PATH."job-offer.php");
        }

        public function ShowAddView()
        {
            require_once(VIEWS_PATH."student-add.php");
        }

        public function ShowListView()
        {
            $this->Add();
            //$studentList = $this->studentDAO->retrieveStudentsJson();
            //$studentList = $this->studentDAO->GetAll();
            //$studentList = $this->studentDAO->GetByEmail("dhasely4@blinklist.com");

            require_once(VIEWS_PATH."home.php");
        }

        public function Add(){
            $studentList = $this->studentDAO->retrieveStudentsJson();
            if($this->verifyGetAll()){
                foreach($studentList as $student){
                    if(!$this->verifyId($student->getIdStudent())){
                        $this->studentDAO->Add($student);
                    }
                }
            }

        }

        public function GetAll(){

            try{
                
                $studentArray = $this->studentDAO->GetAll();
                $newStudentArray = array();
                foreach($studentArray as $student){
                    array_push($newStudentArray, $student);
                }
                return $newStudentArray;
            }
            catch(\PDOException $e){
            
                $message = $e->getMessage();
                $this->homeController->StudentView($message);
                return null;
            }            
        }

        public function GetAllActive(){

            try{
                $studentArray = $this->GetAll();
                $newStudentArray = array();
                foreach($studentArray as $student){
                    if($student->getActive() == 1){
                        array_push($newStudentArray, $student);
                    }
                }
                return $newStudentArray;
            }
            catch(\PDOException $e){
            
                $message = $e->getMessage();
                $this->homeController->StudentView($message);
                return null;
            }             
        }

        public function GetByEmail($email){
            try{
                if($this->verifyEmail($email)){
                    $student = $this->studentDAO->GetByEmail($email);
                    if($student->getEmail() == $email){
                        return true;
                    }
                    return false;
                }
                return false;
            }
            catch(\PDOException $e){
                $message = $e->getMessage();
                $this->homeController->StudentView($message);
            }
        }

        public function verifyGetAll(){
            if(!empty($this->GetAll())){
                return true;
            }
            else{
                return false;
            }
        }

        public function verifyEmail($email){
            $studentList = $this->GetAll();
            foreach($studentList as $student){
                if($student->getEmail() == $email){
                    return true;
                }
            }
            return false;
        }

        public function verifyPassword($password){
            $studentList = $this->GetAll();
            foreach($studentList as $student){
                if($student->getPassword() == $password){
                    return true;
                }
            }
            return false;
        }

        public function verifyId($id){
            $studentList = $this->GetAll();
            foreach($studentList as $student){
                if($student->getIdStudent() == $id){
                    return true;
                }
            }
            return false;
        }

        public function updatePassword($email, $password){
            if($this->verifyEmail($email)){
                $this->studentDAO->updatePassword($email, $password);
            }
        }
        
    }
?>