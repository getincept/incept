# 1 Getting Started

We can download the Incept framework here on [github].
Then we copy the folder to our working directory and we are ready to go. Incept is a modular framework, which means that the minimum amount of modules we need are:

    Incept
    │   index.php
    │   .htaccess
    └─── config
    │   └─── Database.php
    │   └─── Paths.php
    │   └─── Servertime.php
    └─── controllers
    └─── library
    │   └─── Controller.php
    │   └─── Database.php
    │   └─── Model.php
    │   └─── Starter.php
    │   └─── View.php
    └─── models
    └─── views

The complete framework includes the following folder structure:

    Incept
    │   index.php
    │   .htaccess
    └─── config
    │   └─── Database.php
    │   └─── Library.php
    │   └─── Paths.php
    │   └─── Servertime.php
    └─── controllers
    │   └─── Error.php
    │   └─── Index.php
    └─── library
    │   └─── Captcha.php
    │   └─── Controller.php
    │   └─── Database.php
    │   └─── Image.php
    │   └─── Model.php
    │   └─── Sanatize.php
    │   └─── Session.php
    │   └─── Starter.php
    │   └─── View.php
    │   └─── Zip.php
    └─── models
    └─── public
    │   └─── css
    │   │   └─── style.css
    │   └─── fonts
    │       └─── HomBoldB_16x24_LE.gdf
    │   └─── img
    │       └─── bg
    │            └─── bg8.jpg
    │   └─── js
    └─── views
        └─── error
        │   └─── index.php
        └─── index
        │   └─── index.php
        └─── footer.php
        └─── header.php
        └─── headerlogged.php

# 2 Config

Inside of the config folder there are files that are needed for the configuration of the framework for our needs.
This folder includes the Database configure file, the Paths configure file, and the Servertime configure file.

## Config Database.php

This files is here to organize our database connection details for a mysql database.
We can declare the database type (DB_TYP), the hostname (DB_HOST), the database name (DB_NAME),
the user (DB_USER), and the password (DB_PW).

```php
    //MYSQL
    define("DB_TYP", "mysql");
    define("DB_HOST", "localhost");
    define("DB_NAME", "");
    define("DB_USER", "root");
    define("DB_PW", "");
```
by default the settings are as above.

## Config Library.php

This file is here to organize every CONSTANTS that are used in the library modules.

## Config Paths.php

This files is here to organize our absolute path to our root directory,
and to the absolute path to our image folder. We can declare the URL to our root (URL),
and the URL to our image folder (URL_IMAGE).
```php
    define("URL", "DEFINE our PATH");
    define("URL_IMAGE", "DEFINE our PATH TO our IMAGE FOLDER");
```
by default the settings are as above.

## Config Servertime.php

This files is here to set a CONSTANT for our servertime to access it anywhere quickly.
We can declare the time of our Server (SERVER_TIME).
```php
    define("SERVER_TIME",date_default_timezone_set("Europe/Vienna"));
```
by default the settings are as above.

# 3 Controllers

This is the folder where all our controller files are stored. By default there is a Index.php and a Error.php.
We do not need them if we want to create our own Index and Error page. The Incept framework has a convention
for naming controllers - every controller has to start UPPERCASE and has to be named as the view folder(see 8.1).

The controller is automatically instantiated if the first part of the URL-Path contains the name of the controller.
For example: "http://www.exampledomain.com/test". In this case "/test" is redirected on our index.php in our root
directory where the Starter class is instantiated which creates our controller that is called like the first part
of the URL-Path.

#### Error

The Error controller creates a standard view when one of the following HTTP-Statuscodes 401, 402, 403, 404, 405 return.

In the .htaccess the indexes are disabled and for every HTTP-Status we redirect to the standard error view which
says - "An error occurred, please try again!".

The following code is a excerpt of the .htaccess file.
```.httaccess
Options All -Indexes

ErrorDocument 401 http://localhost/Incept/error
ErrorDocument 402 http://localhost/Incept/error
ErrorDocument 403 http://localhost/Incept/error
ErrorDocument 404 http://localhost/Incept/error
ErrorDocument 405 http://localhost/Incept/error
```
by default the settings are as above. If we have a "different" file structure we need to rename these URLs
(This is the case if we rename the root directory (Incept)).

The following code is the Error controller.
```php
//This is the error Controller
//this controller is shown at a error
//but we can modify the error view
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
        $this->view->create("error/index",true);
    }
}
```
How we create and use controllers we will learn in the next section (see 3.1).

#### Index

The Index view creates a standard view which is displayed if we access the the root of our project.
We can modify it in any way we want.

The following code is the Index controller.
```php
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
```
How we create and use controllers we will learn in the next section (see 3.1).

## 3.1 Create a controller

This section will teach us how to create and use controllers properly. There are some conventions we have to follow.
We will start by creating a new file, followed by naming the controller, creating the class, and creating functions.

First we create a new file inside of the controllers folder. The name of the controller has to have the exact same name
as the view but the first letter has to be UPPERCASE. The ending of this file is ".php".
In this documentation we work with a imaginary file called "Test.php".

Inside of every php file we have to open and close the php-tags.
```php
<?php

?>
```

Next we need to create a new php class which has to be named exact same as the file.
```php
<?php
class Test
{

}
?>
```
Our Test.php has to extend the "Mastercontroller" that is inside of our library folder, and called "Controller.php".
The first function we create is the __construct function and call the parent __construct.
```php
<?php
class Test extends Controller
{
    function __construct()
    {
        parent::__construct();
    }
}
?>
```

## 3.2 Render a view

To actually create a view to be shown inside of the browser window we need a index function, and a view that is called
like our controller inside of the views directory (see 7.1). The next step is to create the index view and call the
create function on the "Masterview", which is located in the library directory. The "Masterview" is "required" in our
index.php in our root directory, which is automatically created in our "Mastercontroller" when we call the
"parent::__construct() function" in our Test class (see 4.7, 4.8, and 8). A new Object of the Starter class is created
in our index.php in our root directory. This Starter class creates a new Controller, in this case the "Test.php".
```php
<?php
class Test extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $this->view->create("test/index",true);
    }
}
?>
```
In our index function we call the create function from the "Masterview" which takes three arguments by default (see 4.8).
The parameter "name ($name)" as a String, the parameter "include header and footer ($includeHeaderFooter)" as a boolean,
and the parameter "logged ($logged = false)" as a boolean, which is automatically set to false.

Our first parameter is "test/index", because require the view inside of the create function in the "Masterview".
The Incept framework convention for creating a view is to create a folder inside the views directory and name it like
our view. In our case it is "test", inside of this folder we have to create a index.php (we can name it anyway we want,
but then we have to change "test/index" to "test/'our new name'") (see 4.8). Inside of the "test/index.php" we write our
plain html on javascript that is displayed in the browser (see 7.1).

The second parameter is "true" or "false". This parameter is here to include or not include the header and footer template
that are inside of the views directory (see 7).

The third parameter is "true" or "false". This parameter is here to include or not include (by default)
a different header (see 7) when we have a separate area for logged in user.

## 3.3 Call to a model

The model for this Controller is automatically created inside of the "Mastercontroller" if a file exists that is named
like the Incept framework convention for a model (see 5.1). A model has to be named like our view + "_model.php"
with the first letter UPPERCASE. In our case "Test_model.php".
Our model is "required" when our Starter class is instantiated. In the starter class a new Controller gets
instantiated and after that the function loadModel is called (see 4.7). If a model exists for this controller the model
gets instantiated.
```php
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
```

Inside of our controller "Test.php" we can create new functions to access functions on the model.
So we create a new function "callAModelFunction" to call
"aModelFunction".
```php
<?php
class Test extends Controller
{
    function __construct(){ ... }

    function index(){ ... }

    function callAModelFunction()
    {
        $this->model->aModelFunction();
    }
}
?>
```

#### POST parameters for a function on our model

If our function on the model takes arguments we pass them inside of the brackets. In this example we use test POST
values from a from that is on our view.

A function on a controller gets automatically called when we pass a second part for our URL-Path. For example:
"http://www.exampledomain.com/test/callAModelFunction". In this case "/test" is our controller
and "/callAModelFunction" is the function on the controller which gets called in the Starter class
if a second URL-Path part is passed.

The following code is on our example view "test/index.php" in our view folder (see 7.1).
```html
<form action="test/callAModelFunction" method="POST">
    <input type="text" name="test_post_value1" />
    <input type="text" name="test_post_value2" />
    <button type="submit">Post it!</button>
</form>
```

If the button of this form gets clicked the form gets Posted to the server.

The following code explains how we can use POST parameters in a function we call on a model.
```php
<?php
class Test extends Controller
{
    function __construct(){ ... }

    function index(){ ... }

    function callAModelFunction()
    {
        $testValue1 = $_POST["test_post_value1"];
        $testValue2 = $_POST["test_post_value2"];
        $this->model->aModelFunction($testValue1,$testValue2);
    }
}
?>
```

On our model "Test_model.php" we need to create a function called "aModelFunction". How we can create and use a
model we learn in section 5.1.

The following code is a example of our "Test_model.php".

```php
<?php

class Test_model extends Model
{
    function __construct(){ ... }

    function aModelFunction($value1,$value2)
    {
        //do some crazy stuff with POST parameters...
    }
}

?>
```

#### Parameters to pass in our controller function to access server data

we can pass up to 6 arguments inside of a controller function to access get different information from the server.
A function that takes arguments gets called automatically if we pass a third, fourth, fifth, etc part in we URL-Path.
For example:
"http://www.exampledomain.com/test/getBlogPost/12". In this case "/test" is our controller, "/getBlogPost" is the
function on the controller which gets called in the Starter class if a second URL-Path part is passed, and "/12" is
the parameter that gets passed inside the function. In our case we want to load the blog post with the id 12.

The following code is our "Test.php".
```php
<?php
class Test extends Controller
{
    function __construct(){ ... }

    function index(){ ... }

    function callAModelFunction(){ ... }

    function getBlogPost($blogId)
    {
        $this->model->getBlogPost($blogId);
    }
}
?>
```

The following code is our "Test_model.php".
```php
<?php

class Test_model extends Model
{
    function __construct(){ ... }

    function aModelFunction($value1,$value2){ ... }

    function getBlogPost($blogId)
    {
        //Get our Blogpost from the database
        //and do crazy stuff with it
    }
}

?>
```
# 4 Library

Inside of this folder we will find all the Incept framework extensions. This folder also holds the "Masterview",
"Mastercontroller", "Mastermodel" and the "Starter" class. These 4 files are required to work with this framework.
All this files are included ("required") in the index.php in our root directory. A object of the "Starter.php"
is instantiated in the index.php in our root directory (see 8).

## 4.1 Library Captcha.php

The captcha class was created with a tutorial on [Sitepoint], the original author is [Mehul Jain].
This class is slightly modified to fit for the Incept framework.

The following code is a exerpt from the Captha class.
```php
<?php
class Captcha
{

    public static function createImage(){ ... }

    public static function verifyCaptcha($userInput){ ... }

}
?>
```

To call a function from the captcha class anywhere in our code, this file has to be "required" in the index.php in our
root directory, by default this is the case (see 8). Then we call the class, by type the classname "Captcha"
followed by "::" and "createImage" the function name. To display a captcha in the browserwindow when we request
the "test/index.php" we could call the "createImage" function in the "index" function on our "Test" controller.

The following code is a example code.
```php
<?php
class Test extends Controller
{
    function __construct(){ ... }

    function index()
    {
        Captcha::createImage();
        $this->view->create("test/index",true);
    }

    function callAModelFunction(){ ... }

    function getBlogPost($blogId){ ... }
}
?>
```
The code above will create a file called "image.png" in our root directory. This file is created every
time we request our "test/index.php" and will automatically overwrite the old captcha image.

Now we have to create a "image tag" on our "test/index.php" to display the created image.

The following code is a example code of our "test/index.php".
```html
<!-- We set the source to our created captcha
image and set the width to 200 and height to 50 -->
<img class="captcha" src="image.png" width="200" height="50" />
<!-- We create a form, and have to validate
whether the userinput matches the captcha_string
We call a function on our Check controller-->
<form action="check/checkCaptcha" method="POST">
    <input type="text" name="captcha_user_input" />
    <button type="submit">Verify<button>
</form>
```

The following code is a exerpt of the Captcha.php
```php
public static function verifyCaptcha($userInput)
    {
        if($userInput == Session::get("captcha_string"))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
```

To validate the user input we make use of the "verifyCaptcha" function. When the button in our form gets
clicked we call the function "checkCaptcha". Now inside of this function we call the "verifyCaptcha" function,
or we pass the POST parameter to the model (which is recommended, but in this documentation we check it in the controller).

we can create controller even if there is no matching view but then the index function is empty.

```php
<?php
class Check extends Controller
{
    function __construct()
    {
        Captcha::createImage();
    }

    function index()
    {

    }

    function checkCaptcha()
    {
        if(Captcha::verifyCaptcha($_POST["captcha_user_input"]))
        {
            //do some stuff
        }
        else
        {
            //return a error "Captcha was wrong"
        }
    }
}
?>
```

#### How does the createImage function and the verifyCaptcha function work?

The following code is the complete Captcha.php file which is located in our library folder. This code is commented.
If we read the comments we will understand how this function works.
```php
<?php
class Captcha
{
    public static function createImage()
    {
        //We initialize a Session
        Session::init();
        //We create a new image: width 200px and height 50px
        //and save it into the variable $image
        $image = imagecreatetruecolor(200, 50);
        //We load a font called "HomBoldB_16x24_LE"
        //and save it into the variable $font
        $font = imageloadfont("./public/fonts/HomBoldB_16x24_LE.gdf");
        //we allocate a background color for our $image (in this case white)
        //and save it into the variable $background_color
        $background_color = imagecolorallocate($image, 255, 255, 255);
        //We create a rectangle on our $image that has the same
        //size as our image and fill it with our backgroundcolor
        imagefilledrectangle($image,0,0,200,50,$background_color);
        //we allocate a line color for our $image lines (in this case red)
        //and save it into the variable $line_color
        $line_color = imagecolorallocate($image, 255,0,0);
        //Now we loop 15 times to create 15 lines on our $image
        //that have the same length as the image width
        // but random starting and ending points
        for($i=0;$i<15;$i++)
        {
            imageline($image,0,rand()%50,200,rand()%50,$line_color);
        }
        //we allocate a pixel color for our $image noise (in this case blue)
        //and save it into the variable $pixel_color
        $pixel_color = imagecolorallocate($image, 0,0,255);
        //Now we loop 1800 times to create 1800 pixel on our $image
        //to create image noise. They have random positions
        for($i=0;$i<1800;$i++)
        {
            imagesetpixel($image,rand()%200,rand()%50,$pixel_color);
        }
        //In this string we define the letters and numbers
        // wich should be rendered on our $image
        //By default letters O,o,I,l, and numbers 0,1 are not inside
        //because it is difficult to read
        $letters = "ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnpqrstuvwxyz23456789";
        //we save the length of the string inside of the variable $len
        $len = strlen($letters);
        //we create an empty string for our final $word which
        //is rendered on the image
        $word="";
        //we allocate a text color for our $image text (in this case a darkgray)
        //and save it into the variable $text_color
        $text_color = imagecolorallocate($image, 0,12,12);
        //Now we loop 6 times to create 6 letters on our $image
        //They have a predefined position on the $image
        //in every loop we add the new random $letter to our $word
        for ($i = 0; $i< 6;$i++)
        {
            $letter = $letters[rand(0, $len-1)];
            imagestring($image, $font,  5+($i*30), 20, $letter, $text_color);
            $word.=$letter;
        }
        //The $word is set in a Session called "captcha_string"
        Session::set("captcha_string",$word);
        //Create the $image called "image.png"
        imagepng($image, "image.png");
    }

    //In the verifyCaptcha function we pass the $userInput
    //which should be a POST value
    public static function verifyCaptcha($userInput)
    {
        //Here we compare the $userInput with our
        //"captcha_string" thats saved in the Session
        if($userInput == Session::get("captcha_string"))
        {
            //if the compared strings are equal we return true
            return true;
        }
        else
        {
            //if the compared strings are not equal we return false
            return false;
        }
    }
}
?>
```
## 4.2 Library Controller.php

This file represents the "Mastercontroller". All of our controllers have to extend this "Mastercontroller".
The constructor of this class creates the "Masterview". This class also includes the function loadModel, which
requires the model and instantiate it, only if a model exists.

The following code is an excerpt of our "Test.php", which extends the Controller.
As we see, inside of the __construct function we call the parent __construct.
```php
<?php

class Index extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function index(){ ... }
}

?>

```

The following code is an excerpt of the Controller.php inside of our library folder, which is the Mastercontroller.

```php
<?php

//This is the Mastercontroller
class Controller
{
  //When this controller is loaded
  //it instantiates a new Masterview.
  function __construct()
  {
    $this->view = new View();
  }

  //This function loads a model
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
```

## 4.3 Library Database.php

This class tries to create a database connection, if instantiated. To make use of this class, we need to set our connection
details in the Database.php in our config folder. This class extends the PHP Data Objects (PDO) extension. We call the
__construct function of this PDO extension. It takes three arguments. The dns, the username and the password of the database.
If there is a problem with our database connection it throws an exception and loads the error view. If we want to debug
simply remove the comment in front of echo $e and comment everything else in the catch statement.

```php
<?php

/*
 * author: aichbauer lukas
 * version: 0.1
 * date: 8 Apr 2016
 *
 * The database class tries
 * to create a database connection.
 * If there is a problem with
 * the connection it loads
 * the error controller,
 * and creates an
 * error view.
 */


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
```

## 4.4 Library Image.php

This class allows us to upload Images to our server. The Image class has two static function the uploadImage,
and the compressImage. We normally use the uploadImage function only, because the compressImage function is called
anyways. If we want to upload an Image we need a view with an <form> that has an argument enctype="multipart/form-data"
and a <input> with an argument type="file". A controller that gets the POST data and give call a function on the model
that includes the uploadImage function.

The following code is an example for the "test/index.php".
```html
<form action="test/imageUpload" method="POST" enctype="multipart/form-data">
    <input type="file" name="test-image">
    <button type="submit" name="submit-image">Image upload!</button>
</form>
```

The following code is an example for the Test.php.
```php
<?php
class Test extends Controller
{
    function __construct(){ ... }

    function index(){ ... }

    function callAModelFunction(){ ... }

    function getBlogPost($blogId){ ... }

    function imageUpload()
    {
        $input_name         = "test-image";
        $submit_button_name = "submit-image";

        $this->model->imageUpload($input_name,$submit_button_name);
    }
}
?>
```

The following code is an example of our Test_model.php.
```php
<?php

class Test_model extends Model
{
    function __construct(){ ... }

    function aModelFunction($value1,$value2){ ... }

    function getBlogPost($blogId){ ... }

    function imageUpload($input_name,$submit_button_name)
    {
        $picturePath = Image::uploadImage("directory/where/we/want/to/save/it",
                                          $input_name,
                                          $submit_button_name);
    }
}

?>
```

Now our image is stored on our web server in the "directory/where/we/want/to/save/it". If this directory
does not exist it automatically creates one for we.

## 4.5 Library Model.php

This file represents the "Mastermodel". All of our models have to extend this "Mastermodel".
The constructor of this class creates a new object of the Database class.

The following code is an excerpt of our "Test_model.php", which extends the Model.
As we see, inside of the __construct function we call the parent __construct.


```php
<?php

class Test_model extends Model
{
    function __construct()
    {
        parent::__construct();
    }
}

?>
```

The following code is an excerpt of the Model.php inside of our library folder, which is the Mastermodel.
```php
<?php

/*
 * The master model
 * creates a new
 * Database object
 */
class Model
{

  function __construct()
  {
    $this->db = new Database();
  }
}


?>
```

## 4.6 Library Sanitize.php

This class allows us to sanitize our input fields, like "<input type="text"/>", "<textarea></textarea>" and many more.
Every String input can be sanitized to only allow predefined HTML tags, like <a>,<img> and so on. This function
only allows HTML the attributes "href" and "target" for any HTML elements. It also cleans every HTML attribute value,
like "javascript:", "onclick" and many more.

To take a look at which tags are allowed or which HTML attribute values are disabled, we can go to the config folder
and open the "Library.php". This file defines all the CONSTANTS that are used inside of the library modules. we can
navigate to Sanitize and if we like to allow more or different HTML tags we can change the CONSTANTS.

The following code is a excerpt of the Library.php in the config folder.
```php
<?php

//In this file we can set the
//constants for every library
//module

//SANITIZE
define("ALLOWED_HTML_TAGS", "<a><b><blackquote>
                            <code><del><dd><dt><em><h1><h2><h3>
                            <i><img><kbt><li><ol><p><pre><s><sup>
                            <sub><strong><strike><ul><br><hr>");
define("KEEP_HTML_ATTRIBUTES", 'href,target');
define("DISABLE_HTML_ATTR_VALUES", "javascript:,
                                    onclick,
                                    ondblclick,
                                    onmousedown,
                                    onmouseup,
                                    onmouseover,
                                    onmousemove,
                                    onmouseout,
                                    onkeypress,
                                    onkeydown,
                                    onkeyup,
                                    onMouseOver");

?>

```

The following code is a example of our "Test_model.php". We use the function aModelFunction to save the POST
parameters we get from our controller sanitized into our database (see 3.3 for the controller function)(see 5.2
for the model function and the database).

```php
<?php

class Test_model extends Model
{
    function __construct(){ ... }

    function aModelFunction($value1,$value2)
    {
        //we create a variable sqlSaveTestValue
        //where we prepare our SQL statement
        //inside of our __construct we load
        //the parent::__construct() where we
        //load where we instantiate a new object
        //of the Database class which extends
        //the PDO class
        //we make use of a prepared statement to
        //make sure that sql injections does not
        //work in our applications
        $sqlSaveTestValue = $this->db->prepare("INSERT
                                                INTO
                                                test_table
                                                (testvalue1,
                                                testvalue2)
                                                VALUES
                                                (:1,:2)");
        //Now we execute our statement and fill
        //our placeholder ":1" and ":2" with our
        //variables that are the post values
        //from our form on our view
        // do make sure that only the HTML tags
        //that we allowed are saved into the database
        //we call our sanatizeInput function
        //This function also makes sure that only
        //html attributes like "href" and "target"
        //are saved into our database
        //The last thing the sanatizeInput function
        //does is that these attributes do not
        //take values like "javascript:", "onclick"
        //and many more
        $sqlSaveTestValue->execute(array(":1"=>Sanatize::sanatizeInput($value1),
                                         ":2"=>Sanatize::sanatizeInput($value2)
                                        ));
        //finally we redirect our user back to our index page
        header("Location:".URL."index");
    }
}

?>
```


## 4.7 Library Session.php

This file is a simple but useful session handler.
Instead of "$_SESSION["key"] = value" we can write "Session::set(key,value);", and
instead of "$_SESSION["key"]" to get the value of a session we write "Session::get(key);".
To initialize a session we write "Session::init();", and to stop we write "Session::destroy();".
we can use this class to handle our session or we use the default php style.

The following code is the Session.php in our library folder.

```php
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
```

## 4.7 Library Starter.php

The Starter class takes care of the routing and of instantiating the controller and calling the loadModel function
if a model exists. First we get the get the URL-PATH and split the URL-Path at a slash ("/"). When the URL-Path is
empty we require the "controller/Index.php", create a new object and call the index function on the controller, to
load the "index/index.php" view. If there is a URL-Path we check if a controller named like the URL-Path exists, and
then we load this controller and the index on this controller. For example:

"http://www.example.com/controllername"

If this controller does not exist we load the standard error view. If our URL-Path is longer than one part we check
if this function on this controller exists. For example:

"http://www.example.com/controllername/controllerfunction"

The URL-Path can take up to 8 parts. The first is the controller. The second is the function on the controller.
The part 3-8 are variables that we can pass in a controller function. For example:

"http://www.example.com/controllername/controllerfunction/controllervariable1/controllervariable2"

If this function does not exist or the function does not have the expected parameter, the standard error view will
be called.

This file is required in the index.php in our root directory and a object of this class gets instantiated.

The following code is the Starter.php in our library folder.
```php
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
```

## 4.8 Library View.php

This file represents the "Masterview". All of our controllers instantiate a new View. The "Masterview" has a
function called create. This function takes three arguments, the "$name" of the view, the "$includeHeaderFooter" that
includes a our header and footer template in our views directory, and the "$logged" argument, if this is set to true
it loads a different header.

The following code is the View.php in our library directory.
```php
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
```

The create function is normally called in our controller. If we do not want to include the templates,
we set the second parameter to false. The "$logged" argument is by default set to false.

## 4.9 Library Zip.php

This class allows us to download folders that are stored on our web server.
The original author is [David Bainridge], and this is created with the following tutorial on
[codesythesis]

The following code is an example, on how we can use it to download files.
```php
    function downloadAFolder()
    {
        //this is the name of our download folder
        $zip_name = 'zip_' . time() . '.zip';
        //this represents the directory which we want to download
        $zip_directory = '';
        //we create a new object of our zip class
        //we have to pass a name and a directory
        $zip = new Zip( $zip_name, $zip_directory );
        //here we add our directory that is on our web server
        $zip->add_directory( 'library' );
        //we call the save function, to close the zip file
        $zip->save();
        //get the absolute path of the zip file
        $zip_path = $zip->get_zip_path();
        //header information to force a download
        header( "Pragma: public" );
        header( "Expires: 0" );
        header( "Cache-Control: must-revalidate, post-check=0, pre-check=0" );
        header( "Cache-Control: public" );
        header( "Content-Description: File Transfer" );
        header( "Content-type: application/zip" );
        header( "Content-Disposition: attachment; filename=\"" . $zip_name . "\"" );
        header( "Content-Transfer-Encoding: binary" );
        header( "Content-Length: " . filesize( $zip_path ) );
        //Reads a file and writes it to the output buffer.
        readfile( $zip_path );
    }
```

The following code is the Zip.php in our library folder.
```php
<?php
//This file was created with the tutorial on
//http://www.codesynthesis.co.uk/tutorials/zip-a-directory-and-automatically-download-using-php
//The original author is David Bainridge (https://plus.google.com/101305831980390329128/posts)

//This file allows us to zip
//and download a file from
//the server
class Zip
{
   private $zip;
   public function __construct( $file_name, $zip_directory)
   {
        $this->zip = new ZipArchive();
        $this->path = dirname( __FILE__ ) . $zip_directory . $file_name . '.zip';
        $this->zip->open( $this->path, ZipArchive::CREATE );
    }

   /**
     * Get the absolute path to the zip file
     * @return string
     */
    public function get_zip_path()
    {
        return $this->path;
    }

    /**
     * Add a directory to the zip
     * @param $directory
     */
    public function add_directory( $directory )
    {
        if( is_dir( $directory ) && $handle = opendir( $directory ) )
        {
            $this->zip->addEmptyDir( $directory );
            while( ( $file = readdir( $handle ) ) !== false )
            {
                if (!is_file($directory . '/' . $file))
                {
                    if (!in_array($file, array('.', '..')))
                    {
                        $this->add_directory($directory . '/' . $file );
                    }
                }
                else
                {
                    $this->add_file($directory . '/' . $file);                }
            }
        }
    }

    /**
     * Add a single file to the zip
     * @param string $path
     */
    public function add_file( $path )
    {
        $this->zip->addFile( $path, $path);
    }

    /**
     * Close the zip file
     */
    public function save()
    {
        $this->zip->close();
    }
}

?>
```

# 5 Models

This is the folder where all our model files are stored. By default there is no model. In the next section we will
learn how to create and use models properly. A model is meant to be the "brain" of our web application. So all the
logic comes inside a model. A model is instantiated automatically if the first part of the URL-Path contains the the
name of the CONTROLLER! Not the complete model name (see 5.1). For example: "http://www.exampledomain.com/test". In
this case "/test" is redirected on our index.php in our root directory where the Starter class is instantiated wich
creates our controller that is called like this. In the Starter class we call a function on our controller, called
loadModel. If a model named "Test_model.php" exists we require this file and instatiate a new model that is called
"Test_model" (see 4.6).

## 5.1 Create a model

This section will teach we how to create and use models properly. There are some conventions we have to follow.
We will start by creating a new file, followed by naming the model, creating the class, and creating functions.

First we create a new file inside of the models folder. The name of the model has to have the exact same name as
the view but the first letter has to be UPPERCASE, and after that name we have to write "_model". The ending of
this file is “.php”. In this documentation we work with a imaganary file called “Test_model.php”.

Inside of every php file we have to open and close the php-tags.

```php
<?php

?>
```

Next we need to create a new php class which has to be named exact same as the file.
```php
<?php
class Test_model
{

}
?>
```

Our Test_model.php has to extend the “Mastermodel” that is inside of our library folder, and called “Model.php”.
The first function we create is the __construct function and call the parent __construct.
```php
<?php
class Test_model extends Model
{
    function __construct()
    {
        parent::__construct();
    }
}
?>
```
## 5.2 Call to a Database

In this section we will learn how to call a mysql database. For this documentation we have a imaginary database
called "test", and a imaginary table "test_table" with 3 fields called "id", "testvalue1", and "testvalue2".
First we need to configure our database connection. For that task we open the Database.php inside of the config folder.

The following code is a excerpt of the Database.php inside of the config folder.
```php
    //MYSQL
    define("DB_TYP", "mysql");
    define("DB_HOST", "localhost");
    define("DB_NAME", "test");
    define("DB_USER", "root");
    define("DB_PW", "root");
```
The code above is representing imaginary database connection details with a database name "test", with a database
user "root", and a database password "root".

We use the imaginary view "test/index.php" and controller "Test.php", which we have created in the section 3.1 and 3.2.

The following code is a example of our "Test_model.php".
```php
<?php

class Test_model extends Model
{
    function __construct(){ ... }

    function aModelFunction($value1,$value2)
    {
        //we create a variable sqlSaveTestValue
        //where we prepare our SQL statement
        //inside of our __construct we load
        //the parent::__construct() where we
        //load where we instantiate a new object
        //of the Database class which extends
        //the PDO class
        //we make use of a prepared statement to
        //make sure that sql injections does not
        //work in our applications
        $sqlSaveTestValue = $this->db->prepare("INSERT
                                                INTO
                                                test_table
                                                (testvalue1,
                                                testvalue2)
                                                VALUES
                                                (:1,:2)");
        //Now we execute our statement and fill
        //our placeholder ":1" and ":2" with our
        //variables that are the post values
        //from our form on our view
        // do make sure that only the HTML tags
        //that we allowed are saved into the database
        //we call our sanitizeInput function
        //This function also makes sure that only
        //html attributes like "href" and "target"
        //are saved into our database
        //The last thing the sanitizeInput function
        //does is that these attributes do not
        //take values like "javascript:", "onclick"
        //and many more
        $sqlSaveTestValue->execute(array(":1"=>Sanitize::sanitizeInput($value1),
                                         ":2"=>Sanitize::sanitizeInput($value2)
                                        ));
        //finally we redirect our user back to our index page
        header("Location:".URL."index");
    }
}

?>
```
# 6 Public

The public folder represents a storage room for all our public data, including CSS, Fonts, Images, and JavaScript.
Inside of this folder we have a css, a fonts, a img and a js folder. Inside of the css folder there is a file called
style.css, which is already linked in our header.php and our headerlogged.php inside of our views folder. Inside
of the fonts folder there is already one font called HomBoldB_16x24_LE.gdf, which is used in the Captcha class in our
library folder. Inside of the img folder we have a bg folder that holds a file called bg8.jpg. The js folder is by
default empty.

# 7 Views

This is the folder where all our views are stored. By default there is a error folder with a index.php and a index folder
with another index.php. There are also three templates for header and footer (footer.php, header.php, and headerlogged.php).
Inside of our views, we write plain HTML and JavaScript(usualy we link to to a JS file).

The following code is the index.php inside the error folder.
```html
<div id="entry_error">
    <h1>
        An error occured, please try again!
    </h1>
</div>
```
The code above is displaying an error - "An error occurred, please try again!". This view is rendered every time when one
of the following HTTP-Statuscodes 401, 402, 403, 404, 405 return.

The index.php inside of the index folder has no code at all.

The following code is the header.php inside the views folder.
```html
<!DOCTYPE HTML>
<html>
  <head>
    <title>Incept</title>
    <link rel="stylesheet" href="./public/css/style.css" />
  </head>
  <body>

  <div id="header">
    Welcome to INCEPT
  </div>

  <div id="content">
```
by default it is declaring a html file, opening the <html> tag, opening and closing the <head> and <body> tag,
and linking to our stylesheet. It also is opening the wrapper div.

The following code is the footer.php inside the views folder.
```html
  </div>
  <div id="footer">
    by John Doe, 2016
  </div>
</body>
</html>
```
by default it is closing the wrapper div, which is opened in the header.php. we can modify this template in any way we want.

To render the "headerlogged.php" instead of the "header.php" we need to pass a third parameter inside of the create
function in our controller (see 3.1 and 4.8).

The following code is the headerlogged.php inside the views folder. We can use this header for example for a member area
to display a different navigation to our users.
```html
<!DOCTYPE HTML>
<html>
  <head>
    <title>Incept</title>
    <link rel="stylesheet" href="./public/css/style.css" />
  </head>
  <body>

  <div id="header">
    Welcome to the MEMBERAREA
  </div>

  <div id="content">
```
by default it is declaring a html file, opening the <html> tag, opening and closing the <head> and <body> tag, and
linking to our stylesheet. It also is opening the wrapper div.

## 7.1 Create a View

This section will teach we how to create and use views properly. there are some conventions we have to follow.
We will start by creating a new folder, a new file, and followed by writing simple HTML.

First we create a new folder inside of our views folder. The name of this folder has to be the same as our controller
but usually written lowercase. inside of this folder we create a "index.php" (case 1), we can name this file different
(case 2) but then we need to pass a different string inside of the create function on our controller.

Now we create a folder called "test" and inside of this folder we create a "index.php" (case 1) and a
"differentname.php" (case 2).

The following code is a excerpt of the "test/index.php" (case 1).
```html
<h1>I am the test/index view</h1>
```
The following code is a excerpt of the "test/differentname.php" (case 2).
```html
<h1>I am the test/differentname view</h1>
```
To render the "test/index.php" we need to call the create function on our "Test.php", our controller for this 2 views.

The following code is a excerpt of the "Test.php" (case 1).
```php
<?php
class Test extends Controller
{
    function __construct(){ ... }

    function index()
    {
        $this->view->create("test/index",true);
    }
}
?>
```

The following code is a excerpt of the "Test.php" (case 2).
```php
<?php
class Test extends Controller
{
    function __construct(){ ... }

    function index()
    {
        $this->view->create("test/differentname",true);
    }
}
?>
```

If we do not want to render the header.php and footer.php in our views folder we have to change the second parameter
to false in the create function.

The following code is a excerpt of the "Test.php" (case 2).
```php
<?php
class Test extends Controller
{
    function __construct(){ ... }

    function index()
    {
        $this->view->create("test/differentname",false);
    }
}
?>
```

If we want to render the headerlogged.php and footer.php then we have to pass true as the second parameter and true as
the third parameter.

The following code is a excerpt of the "Test.php" (case 2).
```php
<?php
class Test extends Controller
{
    function __construct(){ ... }

    function index()
    {
        $this->view->create("test/differentname",true, true);
    }
}
?>
```

# 8 index.php

Every request in we web application is redirected to this file (see 9). This file declares our default charset and
requires all we framework components. The first 5 library components are needed, as well as the 3 config components.
All further library components are optional, and the base of the idea of an modular MVC framework.

The following code is the index.php file inside of our root directory.
```php
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
```

The following code initializes our web application. It loads our controller and our model if we have one.
```php
$app = new Starter();
```


# 9 .htaccess

The .htaccess file configures our web server. We redirect every request to our server to our index.php in our
root directory, disable all indexes, and redirect to our error page when one of the following HTTP-Statuscodes are
returned.
We have to set "AllowOverride All" in our httpd.conf. Ask your webhoster to enable it.
CheckSpelling is not necessary but useful.

The following code is the .htaccess file.
```.htaccess
#If our webserver allows to enable spell check and case check
#CheckSpelling On
#CheckCaseOnly On

#Ask our webhoster to enable the mod_rewrite, if it is disabled
RewriteEngine On

RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-l

RewriteRule ^(.+)$ index.php?url=$1 [QSA,L]

#if our server allows to disable indexes, most server disable them by default
#Options All -Indexes

#change this http://www.ourdomain.com/error
ErrorDocument 401 http://localhost/incept/error
ErrorDocument 402 http://localhost/incept/error
ErrorDocument 403 http://localhost/incept/error
ErrorDocument 404 http://localhost/incept/error
ErrorDocument 405 http://localhost/incept/error
```

[codesynthesis]: <http://www.codesynthesis.co.uk/tutorials/zip-a-directory-and-automatically-download-using-php>
[David Bainridge]: <https://plus.google.com/101305831980390329128/posts>
[Mehul Jain]: <http://www.sitepoint.com/author/mjain/>
[Sitepoint]: <http://www.sitepoint.com/simple-captchas-php-gd/>
[github]: <https://github.com/getincept/incept>
