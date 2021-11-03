<?php

    namespace DAO;

    use Models\Admin;

    class AdminDao{

        private $connection;
        private $adminList = array();
        private $tableName = "administrators";

        public function Add(Admin $admin){

            try{
                $query = "INSERT INTO ".$this->tableName."(email, password) VALUES (:email, :password)";

                $parameters['email'] = $admin->getEmail();
                $parameters['password'] = $admin->getPassword();

                $this->connection =Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters); //el executeNonquery no retorna array, sino la cantidad de datos modificados
                
            }
            catch(\PDOException $ex){
                throw $ex;
            }

        }

        public function GetAll(){
            try{

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();
    
                $result = $this->connection->Execute($query, array());

                foreach($result as $row){
                    $admin = new Admin(
                        $row['id_admin'], 
                        $row['email'], 
                        $row['password']
                    );

                    array_push($this->adminList, $admin);
                }
                return $this->adminList;
            }
            catch(\PDOException $ex){
                throw $ex;
            }
        }

        public function GetByEmail($email){
            try{

                $query = "SELECT * FROM ".$this->tableName." WHERE email = '".$email."'";

                $this->connection = Connection::GetInstance();
    
                $result = $this->connection->Execute($query, array());

                foreach($result as $row){
                    $admin = new Admin(
                        $row['id_admin'], 
                        $row['email'], 
                        $row['password']
                    );

                    array_push($this->adminList, $admin);
                }
                return $this->adminList;
            }
            catch(\PDOException $ex){
                throw $ex;
            }
        }
    }

?>