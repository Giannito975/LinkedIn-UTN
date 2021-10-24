<?php
    namespace DAO;

    use \Exception as Exception;
    use DAO\IDao as IDao;
    use Models\Student as Student;    
    use DAO\Connection as Connection;

    class StudentDAO implements IDao
    {
        private $connection;
        private $tableName = "students";

        public function Add($student)
        {
            try
            {
                $query = "CALL Student_Add(?, ?, ?)";//Se guarda la accion que se hara en la BDD

                $parameters["student_firstname"] =  $student->getFirstName();
                $parameters["student_lastname"] = $student->getLastName();

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
                $studentList = array();

                $query = "CALL Student_GetAll()";//Se guarda la accion que se hara en la BDD

                $this->connection = Connection::GetInstance();

                $result = $this->connection->Execute($query, array(), QueryType::StoredProcedure);//Realiza la llamada a la funcion y se guarda lo que devuelve la funcion de la BDD

                foreach($result as $row)
                {
                    $student = new student();
                    $student->setId($row["id_student"]);
                    $student->setFirstName($row["student_firstname"]);
                    $student->setLastName($row["student_lastname"]);

                    array_push($studentList, $student);
                }
                return $studentList;
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

                $query = "CALL Student_GetById(?)";//Se guarda la accion que se hara en la BDD

                $parameters["id_student"] =  $id;

                $this->connection = Connection::GetInstance();
 
                $result = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);//Realiza la llamada a la funcion y se guarda lo que devuelve la funcion de la BDD
                
                $student = new Student();
                $student->setId($result[0]["id_student"]);
                $student->setFirstName($result[0]["student_firstname"]);
                $student->setLastName($result[0]["student_lastname"]);
                
                return $student;

            }   
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function Update($student)
        {
            try
            {
                $query = "CALL Student_Update(?, ?, ?)";//Se guarda la accion que se hara en la BDD

                $parameters["id_student"] =  $student->getId();
                $parameters["student_firstname"] =  $student->getFirstName();
                $parameters["student_lastname"] = $student->getLastName();
                
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
                $query = "CALL Student_Remove(?)";//Se guarda la accion que se hara en la BDD

                $parameters["id_student"] = $id;

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