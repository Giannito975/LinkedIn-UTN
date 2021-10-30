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

        public function ShowAddView()
        {
            require_once(VIEWS_PATH."student-add.php");
        }

        public function ShowListView()
        {
            //$studentList = $this->studentDAO->retrieveStudentsJson();
            //$studentList = $this->studentDAO->GetAll();

            require_once(VIEWS_PATH."home.php");
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
            $studentArray = $this->GetAllActive();
            foreach($studentArray as $student){
                if($student->getEmail() == $email){
                    return true;
                }
            }
            return false;
        }
        
    }
?>