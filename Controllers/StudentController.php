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

        public function ShowProfileStudentView(){
            require_once(VIEWS_PATH."student-profile.php");
        }

        /*public function ShowJobOfferView(){
                require_once(VIEWS_PATH."job-offer.php");
        }*/

        public function ShowAddView(){  
                require_once(VIEWS_PATH."student-add.php");   
        }

        public function ShowListView() {   
                require_once(VIEWS_PATH."home.php");
        }

        public function ShowRegisterView(){
                require_once(VIEWS_PATH."user-register.php");
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
            if($this->verifyGetAll()){
                
                $studentArray = $this->studentDAO->GetAll();
                $newStudentArray = array();
                foreach($studentArray as $student){
                    array_push($newStudentArray, $student);
                }
                return $newStudentArray;    
            }  
            return null;
        }

        public function GetAllActive(){

            $studentArray = $this->GetAll();
            $newStudentArray = array();
            foreach($studentArray as $student){
                if($student->getActive() == 1){
                    array_push($newStudentArray, $student);
                }
            }
            return $newStudentArray;          
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
            if(!empty($this->studentDAO->GetAll())){
                return true;
            }
            else{
                return false;
            }
        }

        public function verifyEmail($email){
            $studentList = $this->GetAllActive();
            foreach($studentList as $student){
                if($student->getEmail() == $email){
                    return true;
                }
            }
            return false;
        }

        public function verifyPassword($password){
            $studentList = $this->GetAllActive();
            foreach($studentList as $student){
                if($student->getPassword() == $password){
                    return true;
                }
            }
            return false;
        }

        public function verifyStudent2($email, $password){
            if($this->verifyEmail($email)){
                $student = $this->GetByEmail($email);
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
                $message = "User created with exito";
                $this->homeController->HomeView($message);
            }else{
                $message = "El email no es correcto";
                $this->homeController->HomeView($message);
            }
        }
        
    }
?>