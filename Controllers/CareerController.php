<?php 

namespace Controllers;

use DAO\CareerDao;

class CareerController{

    private $careerDao;

    public function __construct()
    {
        $this->careerDao = new CareerDAO();
    }

    public function ShowListView()
    {
        //$careersList = $this->careerDao->retrieveCareersJson();
        require_once(VIEWS_PATH."home.php");
    }
}














?>