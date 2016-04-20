<?php

class Starter
{

  function __construct()
  {

    $url = isset($_GET["url"]) ? $_GET["url"] : null;
    $url = rtrim($url, "/");
    $url = explode("/", $url);
    if(empty($url[0]))
    {
      require("controllers/index.php");
      $controller = new Index();
      $controller->index();
      return false;
    }
    $file = "controllers/".$url[0].".php";
    if(file_exists($file))
    {
      require($file);
    }
    else
    {
      $this->error();
    }
    $controller = new $url[0];
    $controller->loadModel($url[0]);
    if(isset($url[1]))
    {
      if(isset($url[7]))
      {
        if(method_exists($controller, $url[1]))
        {
          $controller->{$url[1]}($url[2],$url[3],$url[4],$url[5],$url[6],$url[7]);
        }
        else
        {
          $this->error();
        }
      }
      if(isset($url[6]))
      {
        if(method_exists($controller, $url[1]))
        {
          $controller->{$url[1]}($url[2],$url[3],$url[4],$url[5],$url[6]);
        }
        else
        {
          $this->error();
        }
      }
      else if(isset($url[5]))
      {
        if(method_exists($controller, $url[1]))
        {
          $controller->{$url[1]}($url[2],$url[3],$url[4],$url[5]);
        }
        else
        {
          $this->error();
        }
      }
      else if(isset($url[4]))
      {
        if(method_exists($controller, $url[1]))
        {
          $controller->{$url[1]}($url[2],$url[3],$url[4]);
        }
        else
        {
          $this->error();
        }
      }
      else if(isset($url[3]))
      {
        if(method_exists($controller, $url[1]))
        {
          $controller->{$url[1]}($url[2],$url[3]);
        }
        else
        {
          $this->error();
        }
      }
      else if(isset($url[2]))
      {
        if(method_exists($controller, $url[1]))
        {
          $controller->{$url[1]}($url[2]);
        }
        else
        {
          $this->error();
        }
      }
      else if(method_exists($controller, $url[1]))
      {
        $controller->{$url[1]}();
      }
      else
      {
        $this->error();
      }
    }
    $controller->index();
  }
  function error()
  {
    require("controllers/error.php");
    $controller = new Error();
    $controller->index();
    return false;
  }

}


?>

