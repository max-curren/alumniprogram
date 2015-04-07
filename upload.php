<form action="" method="POST" enctype="multipart/form-data">
  <input type="file" name="profilePic" accept=".png,.jpg,.jpeg" />
  <input type="submit" name="submit" value="Upload" />
</form>

<?php

  if(isset($_POST["submit"]))
  {
    include "class/Upload.php";
    $uploadClass = new Upload;

    $result = $uploadClass->uploadProfilePic();
    if($result === true)
    {
      echo "success";
    }
    else
    {
      echo $result;
    }
  }
?>