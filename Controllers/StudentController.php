<?php
    namespace Controllers;

    use DAO\StudentDAO as StudentDAO;
    use Models\Student;

    class StudentController
    {
        private $studentDAO;
        private $homeController;

        public function __construct()
        {
            $this->studentDAO = new StudentDAO();
            $this->homeController = new HomeController();
        }

        //hablar con dante san sobre si es provisional o no
        public function ShowProfileView(){
            if($this->checkSessionStudent()){
                require_once(VIEWS_PATH."student-profile.php");
            }
            else{
                $this->Logout();
            }
        }

        public function ShowJobOfferView(){
            if($this->checkSessionStudent()){
                require_once(VIEWS_PATH."job-offer.php");
            }
            else{
                $this->Logout();
            }
        }

        public function ShowAddView(){
            if($this->checkSessionStudent()){
                require_once(VIEWS_PATH."student-add.php");
            }
            else{
                $this->Logout();
            }
        }

        public function ShowListView() {
            if($this->checkSessionStudent()){
                require_once(VIEWS_PATH."home.php");
            }
            else{
                $this->Logout();
            }
        }

        public function ShowRegisterView(){
            if($this->checkSessionStudent()){
                require_once(VIEWS_PATH."user-register.php");
            }
            else{
                $this->Logout();
            }
        }

        public function checkSessionStudent(){

            if(session_status() == PHP_SESSION_NONE){
                session_start();
            }
            if(isset($_SESSION['loggedUser'])){
                return true;
            }
            else{
                return false;
            }
        }

        public function Logout(){
            if(session_status() == PHP_SESSION_NONE)
                session_start();
                session_destroy();
            $this->homeController->Index();
        }

        public function Add(){
            $studentList = $this->studentDAO->retrieveStudentsJson();
            if($this->verifyGetAll()){
                foreach($studentList as $student){
                    if(!$this->verifyId($student->getIdStudent())){
                        $this->studentDAO->Add();
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
                //$this->homeController->StudentView($message);
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
                //$this->homeController->StudentView($message);
                return null;
            }             
        }

        public function GetByEmail($email){
            try{
                if($this->verifyEmail($email)){
                    $student = $this->studentDAO->GetByEmail($email);
                    return $student;
                }
                return null;
            }
            catch(\PDOException $e){
                $message = $e->getMessage();
                //$this->homeController->StudentView($message);
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

        public function verifyStudent2($email, $password){
            if($this->verifyEmail($email) && $this->verifyPassword($password)){
                return true;
            }
            return false;
        }

        public function verifyStudent($email, $password){
            if($this->verifyEmail($email) && $this->verifyPassword($password)){
                $this->homeController->CompanyListView();
            }
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
            $this->homeController->HomeView();
        }
        
    }
?>