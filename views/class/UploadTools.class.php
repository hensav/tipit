<?php

/**
 * Created by PhpStorm.
 * User: clstrfvck
 * Date: 02/01/2017
 * Time: 23:19
 */
class UploadTools
{
    protected static function standardizeName($origin)
    {
        $extension = pathinfo($origin,PATHINFO_EXTENSION);
        $supportedExtensions = array("jpg","gif","jpeg","png");
        if (in_array($extension,$supportedExtensions)) {
            $hash = hash("sha512",$origin);
            $offset = rand(8,strlen($hash));
            $output = substr($hash,$offset-8,8).".".$extension;
        } else {
            $output=false;
        }
        return $output;
    }

    public static function uploadImage(array $input)
    {
        $standardizedFilename = UploadTools::standardizeName($input["fileToUpload"]["name"]);
        
        if ($standardizedFilename==false) {
            return(array(
                "status"=>"failure",
                "errorCode" => 001,
                "message" => "Image type not supported")
            );
        }
        
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($standardizedFilename);

        // Check if image file is a actual image or fake image

        if (isset($_POST["submit"])) {
            $check = getimagesize($input["fileToUpload"]["tmp_name"]);
            if ($check === false) {
                return(array(
                    "status"=>"failure",
                    "errorCode" => 002,
                    "message" => "File is not an image")
                );
            }
        }

        // Check if file already exists, generate new file name. Can't fail twice in a row, right? ....Right?
        if (file_exists($target_file)) {
            $standardizedFilename=$standardizedFilename = UploadTools::standardizeName($input["fileToUpload"]["name"]);
        }

        // Check file size
        if ($input["fileToUpload"]["size"] > 500000) {
            return(array(
                "status"=>"failure",
                "errorCode" => 003,
                "message" => "Image size is too large!")
            );
        }
        
        // If everything above fails to break function, try to actually upload file
        if (move_uploaded_file($input["fileToUpload"]["tmp_name"], $target_file)) {
            return(array(
                "status"=>"success",
                "errorCode" => false,
                "message" => "$standardizedFilename")
            );

        } else {
            return(array(
                "status"=>"failure",
                "errorCode" => 004,
                "message" => "Something went wrong, please try again")
            );
        }
    }
}
