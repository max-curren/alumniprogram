<?php
  include "miscFunctions.php";

  class Upload
  {

    
    function uploadProfilePic()
    {
        if(isset($_FILES["profilePic"]["error"]) && is_array($_FILES["profilePic"]["error"]) == false) //if file exists and is not multiple files
        {
          
          //check for errors
          switch($_FILES["profilePic"]["error"])
          {
            case UPLOAD_ERR_OK:
            break;
            
            case UPLOAD_ERR_NO_FILE:
              return "You didn't upload a profile picture, please try again.";
            break;
            
            case UPLOAD_ERR_INI_SIZE || UPLOAD_ERR_FORM_SIZE:
              return "The filesize is too large, please try uploading a smaller file.";
            break;
            
            default:
              return "An error has occurred, please try again later. (1)";
            break;
          }
          
          //check filesize
          if($_FILES["profilePic"]["size"] > 10000000)
          {
            return "The filesize is too large, please try uploading a smaller file.";
          }
          
          
          //check file type
          $finfo = new finfo(FILEINFO_MIME_TYPE);
          
          if($ext = array_search(
            $finfo->file($_FILES["profilePic"]["tmp_name"]),
            array
            (
              "jpg" => "image/jpeg",
              "png" => "image/png"
            ), true
          ) === false)
          {
            return "The file you uploaded is not a picture, please try again.";
          }
          return $ext;
          $sha1FileName = sprintf("%s.%s", sha1_file($_FILES["profilePic"]["tmp_name"]), $ext);
          
          //name the file and move it into the profilePics folder
          if(move_uploaded_file($_FILES["profilePic"]["tmp_name"], "./profilePics/" . $sha1FileName))
          {
            
            
            if(session_id() == "") //if session isn't already started
            {
              session_start();
            }
            
            include "Database.php";
            $dbObj = new Database;
			      $dbConnection = $dbObj->connectToDB();
            
            $userID = $_SESSION["id"];
            
            $updateProfilePic = $dbConnection->prepare("UPDATE users SET profilePic = '$sha1FileName' WHERE userID = '$userID'");
            
            if($updateProfilePic->execute())
            {
              $_SESSION["profilePic"] = $sha1FileName;
              return true;
            }
            else
            {
              return "An error has occurred, please try again later. (2)"; 
            }
          }
          else
          {
            return "An error has occurred, please try again later. (2)";  
          }
          
        }
        else
        {
          return "An error has occurred, please try again later. (3)";
        }
    }
    
  }

?>