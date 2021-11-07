<?php

namespace Controllers;

use DAO\JobOfferDao;
use DAO\JobOfferXStudentDao;
use DAO\StudentDAO;
use Models\JobOfferXStudent;

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

    public function add($id_student, $jobOfferId){

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