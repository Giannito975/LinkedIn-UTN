<?php

namespace Models;

class Admin{

    private $id_admin;
    private $email;
    private $password;

    public function __construct($id_admin, $email, $password)
    {
        $this->id_admin = $id_admin;
        $this->email = $email;
        $this->password = $password;
    }

    public function getId_admin(){
        return $this->id_admin;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function getPassword(){
        return $this->password;
    }

    public function setPassword($password){
        $this->password = $password;
    }
}


?>