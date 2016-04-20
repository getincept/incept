<?php

//Every view is created inside of the Starter Object

//Disables errormessages. just uncomment next line.
//ini_set( "display_errors", 0);
//Defines our default charset for our webapplication
ini_set("default_charset", "utf-8");

//Includes the different library files
//Comment them if not needed
//Starter, Controller, View,
//Model and Database is required
require("library/Starter.php");
require("library/Controller.php");
require("library/View.php");
require("library/Model.php");
require("library/Database.php");

require("library/Session.php");
require("library/Image.php");
require("library/Zip.php");
require("library/Sanitize.php");
require("library/Captcha.php");

//Includes the different configuration
//Coment them if not needed
require("config/Database.php");
require("config/Paths.php");
require("config/Servertime.php");
require("config/Library.php");


//Initialize our Webapplication
$app = new Starter();

?>