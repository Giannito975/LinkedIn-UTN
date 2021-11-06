<?php

namespace Models;

class JobOfferXStudent{

    private $jobOfferXStudentId;
    private $id_student;
    private $jobOfferId;

    public function __construct($jobOfferXStudentId, $id_student, $jobOfferId)
    {
        $this->jobOfferXStudentId = $jobOfferXStudentId;
        $this->id_student = $id_student;
        $this->jobOfferId = $jobOfferId;
    }

    public function getJobOfferXStudentId(){
        return $this->jobOfferXStudentId;
    }
      
    public function setJobOfferXStudentId($jobOfferXStudentId){
        $this->jobOfferXStudentId = $jobOfferXStudentId;
    }
      
    public function getId_student(){
        return $this->id_student;
    }
      
    public function setId_student($id_student){
        $this->id_student = $id_student;
    }
      
    public function getJobOfferId(){
        return $this->jobOfferId;
    }
      
    public function setJobOfferId($jobOfferId){
        $this->jobOfferId = $jobOfferId;
    }
}


?>