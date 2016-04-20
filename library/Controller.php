<?php

//This is the Mastercontroller
class Controller
{
  //When this controller is loaded
  //it instantiates a new View
  function __construct()
  {
    $this->view = new View();
  }

  //This function loads a model
  //a model is called the same
  //like the Controller but
  //it ends with _model
  //we just need to input
  //the name without the _model
  public function loadModel($name)
  {
    $model = "models/".$name."_model.php";
    
    //if the file exists
    //we require the file
    //and instantiate a
    //new model
    if(file_exists($model))
    {
      require($model);
      $modelName = $name."_model";
      $this->model = new $modelName();
    }

  }
}


?>
