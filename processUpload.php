<?php
  include "class/Upload.php";
  $uploadClass = new Upload;

  $result = uploadProfilePic();
  if($result === true)
  {
    echo "true";
  }
  else
  {
    echo $result;
  }
?>