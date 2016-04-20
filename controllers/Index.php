<?php

//A controller is called like your View
//folder but it starts with upper case,
//it extends the Controller class

class Index extends Controller
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
        $this->view->create("index/index",true);
    }
}

?>