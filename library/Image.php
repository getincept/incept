<?php
    
//This file allows us to upload
//and to compress images to
//our server
//it works with multiple
//images in one input
//field
    
class Image
{
    //Call this function and set the
    //directory - where the image should be saved
    //input_name - the name of the input field with type="file"
    //submit_name - the name of the button from your form
    //compress - if you want to compress the file or not
    //width - of the pitures you upload
    //height - of the pitures you upload
    //compresspercent - the quality of the picture int 0-100F
    public static function uploadImage($directory,$input_name,$submit_name,$compress = true,$width,$height,$compresspercent)
    {

        if(!is_dir($directory))
        {
            mkdir($directory,0777,true);
        }

        for($i = 0; $i<count($_FILES[$input_name]["name"]);$i++)
        {
            $target_dir = $directory."/";
            $target_file = $target_dir.basename($_FILES[$input_name]["name"][$i]);
            $uploadOk = 1;
            //print 'Here is some more debugging info:';
            //print_r($_FILES);
            //print "</pre>";
            $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
            if(isset($_POST[$submit_name]))
            {
                $check = getimagesize($_FILES[$input_name]["tmp_name"][$i]);
                if($check !== false)
                {
                    //echo "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                }
                else
                {
                    //echo "File is not an image.";
                    $uploadOk = 0;
                }
            }
            // Check if file already exists
            if (file_exists($target_file))
            {
                //echo "Sorry, file already exists.";
                $split_target_file = explode(".",$_FILES[$input_name]["name"][$i]);
                $split_target_file_count = count($split_target_file);
                //echo $split_target_file[0];
                $target_file = $target_dir;
                for($ii = 0; $ii<$split_target_file_count; $ii++)
                {
                    if($ii == 0) $target_file = $target_file.$split_target_file[$ii];
                    else if($ii != $split_target_file_count-1) $target_file.".".$split_target_file[$ii];
                    else if($ii == $split_target_file_count-1) $target_file = $target_file.date('Y-m-d h:i:s', time()).".".$split_target_file[$ii];
                }
                $uploadOk = 1;
                //echo $target_file;
            }
            // Check file size
            if ($_FILES[$input_name]["name"][$i] > 5000000000)
            {
                //echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0)
            {                
                //echo $target_file;
                //echo "Sorry, your file was not uploaded.";
                // if everything is ok, try to upload file
            }
            else
            {
                //echo $target_file;
                if (move_uploaded_file($_FILES[$input_name]["tmp_name"][$i], $target_file))
                {
                    //echo $target_file;
                    if($compress == true)
                    {
                        $name = Image::compressImage($target_file,$target_file,$width,$height,$compresspercent);
                        //echo $compress;
                    }                
                    return $name;
                }
                else
                {
                    //echo "Sorry, there was an error uploading your file.";
                    return "false";
                }
            }
        }
    }
    
    //function to compress the image quality
    //source_url - the url to our image
    //destination_url - the url where the image should be saved
    //max_width - width of the picture
    //max_height - height of the picture
    //quality - the percentage of the compression
    public static function compressImage($source_url, $destination_url,$max_width,$max_height, $quality)
    {
        $info = getimagesize($source_url);
            
        //print 'Here is some more debugging info:';
        //print_r($info[1]/2);
        //print "</pre>";
            
        $width = $info[0];
        $height = $info[1];
            
        $newWidth = 0;
        $newHeight = 0;
         
        if ($info['mime'] == 'image/jpeg') $image = imagecreatefromjpeg($source_url);
        else if ($info['mime'] == 'image/gif') $image = imagecreatefromgif($source_url);
        else if ($info['mime'] == 'image/png') $image = imagecreatefrompng($source_url);
            
        if($width > $height)
        {
            $newWidth = $max_width;
            $ratio = $height/$width;
            $newHeight = $ratio*$max_width;
        }
        if($width < $height)
        {
            $newHeight = $max_height;
            $ratio = $width/$height;
            $newWidth = $ratio*$max_height;
        }
         
        $newImage = imagecreatetruecolor($newWidth, $newHeight);
        imagecopyresampled($newImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
        //save file
        imagejpeg($newImage, $destination_url, $quality);
         
        //return destination file
        return $destination_url;
    }
        
}


?>