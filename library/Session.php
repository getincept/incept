<?php

//this file allows us to initialize Sessions
//set and get the Sessions
//and to destroy Sessions

class Session
{

  //initalize a Session
  public static function init()
  {
    @session_start();
  }

  //set a Session
  //Key - the variable to detect a session
  //value - the value that is conected to the key
  public static function set($key, $value)
  {
    $_SESSION[$key] = $value;
  }

  //returns the value of a Session
  //key - the variable to detect a Session
  public static function get($key)
  {
    if(isset($_SESSION[$key]))
    {
      return $_SESSION[$key];
    }
  }
  
  //destroys every Session
  public static function destroy()
  {
    session_destroy();
  }

}


?>
