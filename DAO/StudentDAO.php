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
                $query= "INSERT INTO ".$this->tableName."(id_student, id_career, first_name, last_name, dni, file_number, gender, birthdate, phone_number) VALUES (:idStudent, :career, :firstName, :lastName, :dni, :fileNumber, :gender, :birthdate, :phoneNumber)";
    
                $parameters['idStudent']=$student->getIdStudent(); //se le ingresa el id porque en este caso NO es auto_increment (ojo los demas DAO)
                $parameters['career']=$student->getIdCareer();
                $parameters['firstName']=$student->getFirstName();
                $parameters['lastName']=$student->getLastName();
                $parameters['dni']=$student->getDni();
                $parameters['fileNumber']=$student->getFileNumber();
                $parameters['gender']=$student->getGender();
                $parameters['birthdate']=$student->getBirthDate();
                $parameters['phoneNumber']=$student->getPhoneNumber();
    
                $this->connection =Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters); //el executeNonquery no retorna array, sino la cantidad de datos modificados
            }
            catch(\PDOException $ex)
            {
                throw $ex;
            }
        }

        public function retrieveStudentsJson(){

            $options = array(
                'http' => array(
                  'method'=>"GET",
                  'header'=>"x-api-key: 4f3bceed-50ba-4461-a910-518598664c08")
            );

            $context = stream_context_create($options);

            $json = file_get_contents('https://utn-students-api.herokuapp.com/api/Student', false, $context);

            $arrayToDecode = ($json) ? json_decode($json, true) : array();

            //var_dump($arrayToDecode);
    
            foreach($arrayToDecode as $valuesArray)
            {
                var_dump($valuesArray);
                $student = new Student(
                    $valuesArray['studentId'], 
                    $valuesArray['careerId'], 
                    $valuesArray['firstName'], 
                    $valuesArray["lastName"],
                    $valuesArray['dni'], 
                    $valuesArray['fileNumber'], 
                    $valuesArray["gender"],
                    $valuesArray["birthDate"],
                    $valuesArray["phoneNumber"]);
                    
                    var_dump($student);

                $this->Add($student);
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