<?php
   $link = mysqli_connect("127.0.0.1", "root", "", "sql");

   if (mysqli_connect_error()) {
      die ("there was an error connecting to database.");
   }

   //$query = "SELECT * FROM login";

   //$insert = "INSERT into login (correo, password) VALUES ('nameless', 'Fuck')";

   $update = "UPDATE login SET password ='shit' WHERE id = '2' LIMIT 1";

   mysqli_query($link, $update);
   
   $query = "SELECT * FROM login";

   if($result = mysqli_query($link, $query)) {
      while  {
         # code...
      }$row = mysqli_fetch_array($result);

      print_r($row);
   }

?>