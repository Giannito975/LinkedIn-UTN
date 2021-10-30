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

        public function ShowAddView()
        {
            require_once(VIEWS_PATH."student-add.php");
        }

        public function ShowListView()
        {
            //$studentList = $this->studentDAO->retrieveStudentsJson();
            $studentList = $this->studentDAO->GetAll();

            require_once(VIEWS_PATH."home.php");
        }

        public function Add($recordId, $firstName, $lastName)
        {
            $student = new Student();
            $student->setId($recordId);
            $student->setfirstName($firstName);
            $student->setLastName($lastName);

            $this->studentDAO->Add($student);

            $this->ShowAddView();
        }
    }
?>