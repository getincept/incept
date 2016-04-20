<?php

/*Captcha was created with the tutorial on
 *http://www.sitepoint.com/simple-captchas-php-gd/
 *the original author is Mehul Jain (http://www.sitepoint.com/author/mjain/)
 *
 *The Captcha class was created by the Incept author to fit into this framework.
 *The createImage function was adjusted by the Incept author to fit into this framework
 * The verify function was written by the Incept author.
 *Aichbauer Lukas
 */

class Captcha
{

    public static function createImage()
    {
        Session::init();
        $image = imagecreatetruecolor(200, 50);
        $font = imageloadfont("./public/fonts/HomBoldB_16x24_LE.gdf");
        $background_color = imagecolorallocate($image, 255, 255, 255);  
        imagefilledrectangle($image,0,0,200,50,$background_color);
        $line_color = imagecolorallocate($image, 255,0,0); 
        for($i=0;$i<15;$i++)
        {
            imageline($image,0,rand()%50,200,rand()%50,$line_color);
        }
        $pixel_color = imagecolorallocate($image, 0,0,255);
        for($i=0;$i<1800;$i++)
        {
            imagesetpixel($image,rand()%200,rand()%50,$pixel_color);
        }
        $letters = "ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnpqrstuvwxyz23456789";
        $len = strlen($letters);
        $word="";
        $text_color = imagecolorallocate($image, 0,12,12);
        for ($i = 0; $i< 6;$i++)
        {
            $letter = $letters[rand(0, $len-1)];
            imagestring($image, $font,  5+($i*30), 20, $letter, $text_color);
            $word.=$letter;
        }
        Session::set("captcha_string",$word);
        imagepng($image, "image.png");
    }

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
    
}


?>