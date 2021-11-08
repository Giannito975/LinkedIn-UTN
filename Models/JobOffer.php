<?php

namespace Models;

class JobOffer{

    private $jobOfferId;
    private $jobPositionId;
    private $id_company;
    private $title;
    private $requirements;
    private $responabilities;
    private $profits;
    private $salary;

    public function __construct($jobOfferId, $jobPositionId, $id_company, $title, $requirements, $responabilities, $profits, $salary)
    {
        $this->jobOfferId = $jobOfferId;
        $this->jobPositionId = $jobPositionId;
        $this->id_company = $id_company;
        $this->title = $title;
        $this->requirements = $requirements;
        $this->responabilities = $responabilities;
        $this->profits = $profits;
        $this->salary = $salary;
    }

    public function getJobOfferId(){
        return $this->jobOfferId;
    }

    public function setJobOfferId($jobOfferId){
        $this->jobOfferId = $jobOfferId;
    }

    public function getJobPositionId(){
        return $this->jobPositionId;
    }

    public function setJobPositionId($jobPositionId){
        $this->jobPositionId = $jobPositionId;
    }

    public function getId_company(){
        return $this->id_company;
    }

    public function setId_company($id_company){
        $this->id_company = $id_company;
    }

    public function getTitle(){
        return $this->title;
    }

    public function setTitle($title){
        $this->title = $title;
    }

    public function getRequirements(){
        return $this->requirements;
    }

    public function setRequirements($requirements){
        $this->requirements = $requirements;
    }

    public function getResponabilities(){
        return $this->responabilities;
    }

    public function setResponabilities($responabilities){
        $this->responabilities = $responabilities;
    }

    public function getProfits(){
        return $this->profits;
    }

    public function setProfits($profits){
        $this->profits = $profits;
    }

    public function getSalary(){
        return $this->salary;
    }

    public function setSalary($salary){
        $this->salary = $salary;
    }

}





?>