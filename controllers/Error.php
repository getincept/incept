<?php

//A controller is called like your View
//folder but it starts with upper case,
//it extends the Controller class

//This is the error Controller
//this controller is shown at a error
//but you can modify the error view
//and create new error views for
//different errors

class Error extends Controller
{
    //When this class is constructed
    //we load the constructor from
    //our parent class
    function __construct()
    {
        parent::__construct();
    }
    
    //this function creates our view
    //we load the create function
    //on our masterview
    function index()
    {
        $this->view->create("error/index",false);
    }
}

?>