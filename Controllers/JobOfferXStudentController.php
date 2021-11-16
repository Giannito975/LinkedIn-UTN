<?php

namespace Controllers;

use DAO\JobOfferDao;
use DAO\JobOfferXStudentDao;
use DAO\StudentDAO;
use Models\JobOfferXStudent;
use Controllers\JobOfferController;
use DAO\CompanyDao;
use Models\JobOffer;

class JobOfferXStudentController{

    private $jobOfferXStudentDao;
    private $student;
    private $jobOffer;
    private $company;

    public function __construct()
    {
        $this->jobOfferXStudentDao = new JobOfferXStudentDao();
        $this->student = new StudentDAO();
        $this->jobOffer = new JobOfferDao();
        $this->company = new CompanyDao();
    }

    public function ApplyJobOffer($id = 0){
        if($id != 0){
            $this->add($id);
        }
        $jobOfferController = new JobOfferController();
        $jobOfferController->JobOfferListViewStudent();
        echo'<script type="text/javascript">
        alert("Aplicación realizada con éxito");
        </script>';
    }

    //Explicación del metodo: nos traemos todos los estudiantes de un job offer.
    public function ShowApplicantsList($id){ //recibo id del jobOffer
        
        $jobOfferXStudentList = $this->jobOfferXStudentDao->getAll();
        $studentsArray = array();
        foreach($jobOfferXStudentList as $jobOfferXStudent){
            if($jobOfferXStudent->getJobOfferId() == $id){
                $student = $this->student->GetById($jobOfferXStudent->getId_student());
                array_push($studentsArray, $student);
            }
        }        
        require_once(VIEWS_PATH."applicants-list.php");
    }

    public function ShowRecordStudent(){

    }

    //Obtengo todos los joboffer a los que aplico el estudiante logueado
    public function ShowStudentsRecord(){

        $student = $_SESSION['loggedUser'];
        $studentEmail = $this->student->GetByEmail($student->getEmail());
        $id_student = $studentEmail->getIdStudent();

        $jobOfferXStudentList = $this->jobOfferXStudentDao->getByIdStudent($id_student);
        $jobOfferList = $this->jobOffer->getAll();
        $jobOfferArray = array();

        $companyList = $this->company->getAll();

        foreach($jobOfferXStudentList as $jobOfferXStudent){
            foreach($jobOfferList as $jobOffer){
                if($jobOffer->getJobOfferId() == $jobOfferXStudent->getJobOfferId()){
                    array_push($jobOfferArray, $jobOffer);
                }
            }
        }
        require_once(VIEWS_PATH."applicant-record-view.php");
    }

    public function add($jobOfferId){

        $student = $_SESSION['loggedUser'];
        $studentEmail = $this->student->GetByEmail($student->getEmail());
        $id_student = $studentEmail->getIdStudent();

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

    public function applicatRecord(){
        $jobOfferArray = array();
        $jobOfferList = $this->jobOffer->getAll();
        foreach($jobOfferList as $jobOffer){
            if($this->verifyJobOfferXStudent($jobOffer->getJobOfferId())){
                array_push($jobOfferArray, $jobOffer);
            }
        }
        return $jobOfferArray;
    }

    public function verifyJobOfferXStudent($jobOfferId){

        $student = $_SESSION['loggedUser'];
        $jobOfferXStudentList = $this->jobOfferXStudentDao->getByIdStudent($student->getIdStudent());
        foreach($jobOfferXStudentList as $jobOfferXStudent){
            if($jobOfferXStudent->getJobOfferId() == $jobOfferId){
                return true;
            }
        }
        return false;
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