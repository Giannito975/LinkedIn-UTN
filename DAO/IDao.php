<?php

namespace DAO;

//Nunca usaron la interfaz
interface IDao{

    function Add($value);
    function Remove($id);
    function GetAll();
    function GetById($id);
    function Update($value);

}

?>