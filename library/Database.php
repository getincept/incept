<?php

//The database class creates
//the database connection
//with the connection details
//we set in the configg folder
class Database extends PDO
{

    function __construct()
    {
        try
        {
            parent::__construct(DB_TYP.":host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PW);
        }
        catch (Exception $e)
        {
            //echo $e;
            require("controllers/error.php");
            $controller = new Error();
            $controller->index();
        }
    }
  
}


?>
