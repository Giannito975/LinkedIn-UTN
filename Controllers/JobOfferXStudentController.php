<?php

namespace Controllers;

use DAO\JobOfferDao;
use DAO\JobOfferXStudentDao;
use DAO\StudentDAO;
use Models\JobOfferXStudent;
use Controllers\JobOfferController;

class JobOfferXStudentController{

    private $jobOfferXStudentDao;
    private $student;
    private $jobOffer;

    public function __construct()
    {
        $this->jobOfferXStudentDao = new JobOfferXStudentDao();
        $this->student = new StudentDAO();
        $this->jobOffer = new JobOfferDao();
    }

    public function ApplyJobOffer($id){
        $this->add($id);
        $jobOfferController = new JobOfferController();
        $jobOfferController->JobOfferListViewStudent();
    }

    //Explicación del metodo: nos traemos todos los estudiantes de un job offer.
    public function ShowApplicantsList($id){ //recibo id del jobOffer
        
        $jobOfferXStudentList = $this->jobOfferXStudentDao->getAll();
        $studentsArray = array();
        foreach($jobOfferXStudentList as $jobOfferXStudent){
            while($jobOfferXStudent->getJobOfferXStudentId() == $id){
                $student = $this->student->GetById($jobOfferXStudent->getId_student());
                array_push($studentsArray, $student);
            }
        }
        
        
        /*
        $jobOfferXStudentList = $this->jobOfferXStudentDao->getAll();
        $student = $this->student->GetByEmail($_COOKIE['loggedStudent']);
        $id_student = $student->getIdStudent();
        $studentsArray = array();
        foreach($jobOfferXStudentList as $jobOfferXStudent){
            if( ( $jobOfferXStudent->getId_student() == $id_student ) 
            && ( $jobOfferXStudent->getJobOfferId() == $id ) ){
                $student = $this->student->GetById($id_student);
                array_push($studentsArray, $student);
            }
        }*/
        require_once(VIEWS_PATH."applicants-list.php");

    }

    public function add($jobOfferId){

        $studentEmail = $_COOKIE['loggedStudent'];
        $student = $this->student->GetByEmail($studentEmail);
        $id_student = $student->getIdStudent();

        if(!$this->verifyStudent($id_student, $jobOfferId)){

            $jobOfferXStudent = new JobOfferXStudent(null, $id_student, $jobOfferId);
        
            $this->jobOfferXStudentDao->add($jobOfferXStudent);
        }
    }

    public function getAll(){
        try{
                
            $jobOfferXStudentArray = $this->jobOfferXStudentDao->GetAll();
            $newjobOfferXStudentArray = array();
            foreach($jobOfferXStudentArray as $jobOfferXStudent){
                array_push($newjobOfferXStudentArray, $jobOfferXStudent);
            }
            return $newjobOfferXStudentArray;
        }
        catch(\PDOException $e){
        
            $message = $e->getMessage();
            $this->homeController->JobPositionView($message);
            return null;
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

    //Verifica si el estudante ya se postulo a este job offer
    public function verifyStudent($id_student, $jobOfferId){
        if($this->verifyGetAll()){
            $jobOfferXStudentList = $this->getAll();
            foreach($jobOfferXStudentList as $jobOfferXStudent){
                if(($jobOfferXStudent->getId_student() == $id_student) && 
                ($jobOfferXStudent->getJobOfferId() == $jobOfferId)){
                    return true;
                }
            }
            return false;
        }
        return null;
    }
}










?>