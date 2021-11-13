<?php

namespace DAO;

use Exception;
use Models\JobOfferXStudent;

class JobOfferXStudentDao{

    private $connection;
    private $jobOfferXStudentList = array();
    private $tableName = "JobOfferXStudent";

    public function add(JobOfferXStudent $jobOfferXStudent){
        try{
            $query = "INSERT INTO " . $this->tableName . "(id_student, jobOfferId) VALUES ( :id_student , :jobOfferId)";

            $parameters['id_student'] = $jobOfferXStudent->getId_student();
            $parameters['jobOfferId'] = $jobOfferXStudent->getJobOfferId();

            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query, $parameters);
        }
        catch (\PDOException $ex) {
            throw $ex;
        }
    }

    function getAll(){
        try {
            $query= "SELECT * FROM ".$this->tableName;

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query, array());

            if (!empty($result)) {

                foreach($result as $row){
                    $jobOfferXStudent = new JobOfferXStudent(
                        $row['jobOfferXStudentId'], 
                        $row['id_student'], 
                        $row['jobOfferId']
                    );

                    array_push($this->jobOfferXStudentList, $jobOfferXStudent);
                }
            }
            return $this->jobOfferXStudentList;

        } catch (\PDOException $ex) {
            throw $ex;
        }
    }

    function remove($jobOfferXStudentId){
        try {
            $query = "DELETE FROM " . $this->tableName . " WHERE (jobOfferXStudentId = :jobOfferXStudentId)";

            $parameters["jobOfferXStudentId"] = $jobOfferXStudentId;

            $this->connection = Connection::GetInstance();

            return $count = $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (\PDOException $ex) {
            throw $ex;
        }
    }

    public function getByIdStudent($id_student){
        try
        {
            $query = "SELECT * FROM ".$this->tableName." WHERE id_student = '".$id_student."'";

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query, array());

            $jobOfferXStudentList = array();
                
            foreach($result as $row){
                $jobOfferXStudent = new JobOfferXStudent(
                    $row['jobOfferXStudentId'], 
                    $row['id_student'], 
                    $row['jobOfferId']
                );
                
                array_push($jobOfferXStudentList, $jobOfferXStudent);
            }
            return $jobOfferXStudentList;
        }   
        catch(Exception $ex)
        {
            throw $ex;
        }
    }

    public function getByIdJobOffer($jobOfferId){
        try
        {
            $query = "SELECT * FROM ".$this->tableName." WHERE jobOfferId = '".$jobOfferId."'";

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query, array());
                
            foreach($result as $row){
                $jobOfferXStudent = new JobOfferXStudent(
                    $row['jobOfferXStudentId'], 
                    $row['id_student'], 
                    $row['jobOfferId']
                );
                array_push($this->jobOfferXStudentList, $jobOfferXStudent);
            }
            return $this->jobOfferXStudentList;
        }   
        catch(Exception $ex)
        {
            throw $ex;
        }
    }

}


?>