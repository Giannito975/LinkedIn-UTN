<?php

namespace DAO;

use \Exception as Exception;
use DAO\Connection as Connection;
use Models\Career as Career;

class CareerDao{

    private $connection;
    private $careerList = array();
    private $tableName = "careers";

    public function Add($career)
    {
        try
        {
            $query= "INSERT INTO ".$this->tableName."(careerId, description, active) VALUES (:careerId, :description, :active)";

            $parameters['careerId']=$career->getCareerId(); //se le ingresa el id porque en este caso NO es auto_increment (ojo los demas DAO)
            $parameters['description']=$career->getDescription();
            $parameters['active']=$career->getActive();

            $this->connection =Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query, $parameters); //el executeNonquery no retorna array, sino la cantidad de datos modificados
        }
        catch(\PDOException $ex)
        {
            throw $ex;
        }
    }

    public function GetByDescription($description)
    {
        try
        {
            $query = "SELECT * FROM ".$this->tableName." WHERE description = '".$description."'";

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query, array());

            foreach($result as $row){
                $Career = new Career(
                    $row['careerId'], 
                    $row['description'], 
                    $row['active']
                    );
            }
            return $Career;
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }

    public function retrieveCareersJson(){

        $options = array(
            'http' => array(
              'method'=>"GET",
              'header'=>"x-api-key: 4f3bceed-50ba-4461-a910-518598664c08")
        );

        $context = stream_context_create($options);

        $json = file_get_contents('https://utn-students-api.herokuapp.com/api/Career', false, $context);

        $arrayToDecode = ($json) ? json_decode($json, true) : array();

        var_dump($arrayToDecode);

        foreach($arrayToDecode as $valuesArray)
        {
            var_dump($valuesArray);
            if($valuesArray['active'] == true){
                $valuesArray['active'] = 1;
            }else{
                $valuesArray['active'] = 0;
            }
            $career = new Career(
                $valuesArray['careerId'], 
                $valuesArray['description'], 
                $valuesArray['active']);
                
            $this->Add($career);
        }
    }

    public function GetAll()
    {
        try
        {
            $careerList = array();

            $query = "SELECT * FROM ".$this->tableName;

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query, array());

            if(!empty($result)){

                foreach($result as $row){
                    $career = new career(
                        $row['careerId'], 
                        $row['description'], 
                        $row['active']
                    );
                    array_push($careerList, $career);
                }
            }
            return $careerList;
        }   
        catch(Exception $ex)
        {
            throw $ex;
        }
    }

    public function GetById($careerId)
    {
        try
        {
            $query = "SELECT * FROM ".$this->tableName." WHERE careerId = '".$careerId."'";

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query, array());
                
            foreach($result as $row){
                $Career = new Career(
                    $row['careerId'], 
                    $row['description'], 
                    $row['active']
                    );
            }
            return $Career;
        }   
        catch(Exception $ex)
        {
            throw $ex;
        }
    }

    public function Update(Career $career)
    {
        try
        {
            $query= "UPDATE ".$this->tableName." SET description = :description, active = :active WHERE (careerId = :careerId)";
            
            $parameters['careerId']=$career->getCareerId(); 
            $parameters['description']=$career->getDescription();
            $parameters['active']=$career->getActive();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
        }
        catch(\PDOException $ex)
        {
            throw $ex;
        }
    }

    public function Remove($careerId)
    {
        try {
            $query = "DELETE FROM " . $this->tableName . " WHERE (careerId = :careerId)";

            $parameters["careerId"] = $careerId;

            $this->connection = Connection::GetInstance();

            return $count = $this->connection->ExecuteNonQuery($query, $parameters);
            
        } catch (\PDOException $ex) {
            throw $ex;
        }
    }


}

?>