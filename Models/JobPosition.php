<?php

namespace Models;

class JobPosition
{

private $jobPositionId;
private $careerId;
private $id_company;
private $description;

    public function __construct($jobPositionId, $careerId, $id_company, $description)
    {
        $this->jobPositionId = $jobPositionId;
        $this->careerId = $careerId;
        $this->id_company = $id_company;
        $this->description = $description;
    }

    public function getJobPositionId()
    {
        return $this->jobPositionId;
    }


    public function setJobPositionId($jobPositionId)
    {
        $this->jobPositionId = $jobPositionId;
    }


    public function getCareerId()
    {
        return $this->careerId;
    }


    public function setCareerId($careerId)
    {
        $this->careerId = $careerId;
    }

    public function getId_company()
    {
        return $this->id_company;
    }


    public function setId_company($id_company)
    {
        $this->id_company = $id_company;
    }


    public function getDescription()
    {
        return $this->description;
    }


    public function setDescription($description)
    {
        $this->description = $description;
    }



}