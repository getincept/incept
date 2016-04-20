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