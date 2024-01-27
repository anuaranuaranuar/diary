<?php
   $link = mysqli_connect("127.0.0.1", "root", "", "sql");

   if (mysqli_connect_error()) {
      die ("there was an error connecting to database.");
   }

   $query = "SELECT * FROM login";

   
   if($result = mysqli_query($link, $query)) {
      $row = mysqli_fetch_array($result);

      print_r($row);
   }

?>