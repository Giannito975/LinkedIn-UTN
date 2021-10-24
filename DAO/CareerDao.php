<?php

namespace DAO;

use \Exception as Exception;
use DAO\IDao as IDao;
use DAO\Connection as Connection;
use Models\Career as Career;

class CareerDao implements IDao{

    private $connection;
    private $tableName = "careers";

    public function Add($career)
    {
        try
            {
                $query = "CALL Career_Add(?, ?, ?)";//Se guarda la accion que se hara en la BDD

                $parameters["career_firstname"] =  $career->getName();
                $parameters["career_lastname"] = $career->getTitle();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);//Realiza la llamada a la funcion en la BDD
            }   
            catch(Exception $ex)
            {
                throw $ex;
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