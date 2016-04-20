<?php

//This file is the masterview
//it allows us to create our views
class View
{
  
  //The function that loads our View
  //name - of the view
  //includeHeaderFooter - boolean if we want our header and footer template
  //logged - boolean to load the header for a member area
  public function create($name, $includeHeaderFooter, $logged = false)
  {
    if($includeHeaderFooter == true && $logged == false)
    {
      require("views/header.php");
      require("views/".$name.".php");
      require("views/footer.php");
    }
    elseif ($includeHeaderFooter == true && $logged == true)
    {
      require("views/headerlogged.php");
      require("views/".$name.".php");
      require("views/footer.php");
    }
    else
    {
      require("views/".$name.".php");
    }
  }
}


?>
