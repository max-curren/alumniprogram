<!DOCTYPE html>
<html lang="en">
  <head>
    <title></title>
    <link href="css/main.css" rel="stylesheet" />
    <link href="css/index.css" rel="stylesheet" />

    <script type="text/javascript" src="js/jquery.js"></script>
  </head>
  <body>

  <?php
    session_start();

    if(isset($_SESSION["id"])) //if signed in
    {
      include "includes/header_user.php";
    }
    else
    {
      header("Location: index.php");
    }

  ?>

  <main>
    <form action="upload.php" method="post" enctype="multipart/form-data">
      Select image to upload:
      <input type="file" name="profilePic" />
      <input type="submit" value="Upload Image" name="submit" />
    </form>
  </main>

  <footer>

  </footer>

  </body>
</html>