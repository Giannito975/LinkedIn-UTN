<?php

namespace DAO;

use \Exception as Exception;
use DAO\IDao as IDao;
use DAO\Connection as Connection;
use Models\Career as Career;

class CareerDao implements IDao{

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

            $query = "CALL Career_GetAll()";//Se guarda la accion que se hara en la BDD

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query, array(), QueryType::StoredProcedure);//Realiza la llamada a la funcion y se guarda lo que devuelve la funcion de la BDD

            foreach($result as $row)
            {
                $career = new career();
                $career->setId($row["id_career"]);
                $career->setName($row["career_name"]);
                $career->setTitle($row["career_title"]);

                array_push($careerList, $career);
            }
            return $careerList;
        }   
        catch(Exception $ex)
        {
            throw $ex;
        }
    }

    public function GetById($id)
    {
        try
            {

                $query = "CALL Career_GetById(?)";//Se guarda la accion que se hara en la BDD

                $parameters["id_career"] =  $id;

                $this->connection = Connection::GetInstance();
 
                $result = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);//Realiza la llamada a la funcion y se guarda lo que devuelve la funcion de la BDD
                
                $career = new career();
                $career->setId($result[0]["id_career"]);
                $career->setName($result[0]["career_name"]);
                $career->setTitle($result[0]["career_title"]);
                
                return $career;

            }   
            catch(Exception $ex)
            {
                throw $ex;
            }
    }

    public function Update($career)
    {
        try
            {
                $query = "CALL Career_Update(?, ?, ?)";//Se guarda la accion que se hara en la BDD

                $parameters["id_career"] =  $career->getId();
                $parameters["career_name"] =  $career->getName();
                $parameters["career_title"] = $career->getTitle();
                
                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);//Realiza la llamada a la funcion
            }   
            catch(Exception $ex)
            {
                throw $ex;
            }
    }

    public function Remove($id)
    {
        try
            {
                $query = "CALL Career_Remove(?)";//Se guarda la accion que se hara en la BDD

                $parameters["id_career"] = $id;

                $this->connection = Connection::GetInstance();

                echo $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);//Realiza la llamada a la funcion en la BDD
            }   
            catch(Exception $ex)
            {
                throw $ex;
            }
    }


}

?>