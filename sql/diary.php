<?php

//$query = "SELECT * FROM login";

$status=true;

function aler($alert,$status){


   
   if ($status==true){
      echo '<div class="alert alert-success Dsuse" role="alert">'
      . $alert .
      '</div>';
      
   }

   if ($status==false){
      echo '<div class="alert alert-danger Dalert" role="alert">'
      . $alert .
      '</div>';
   }

}

if(array_key_exists("id", $_COOKIE)){
   header("location: pag.php");
  }

if (array_key_exists('email', $_POST) or  array_key_exists('password', $_POST)) {
   $link = mysqli_connect("127.0.0.1", "root", "", "sql");

   if (mysqli_connect_error()) {
      die("there was an error connecting to database.");
   }
   if ($_POST['email'] == '') {
      $alert = '<p>falta el correo</p>';
      $status = false;
      
   }
   if ($_POST['password'] == '') {
      echo '<p>falta la contraseña</p>';
   } else {
      $query = "SELECT id FROM login WHERE correo = '"
         . mysqli_real_escape_string($link, $_POST['email']) . "'";

      $result = mysqli_query($link, $query);

      if (mysqli_num_rows($result) > 0) {
         echo '<p>email ya registrado</p>';
         
      } else {
         $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
         $query = "INSERT INTO login (correo , password) VALUES ('"
            . mysqli_real_escape_string($link, $_POST['email']) . "' , '" .
            mysqli_real_escape_string($link, $hash) . "')";

         if (mysqli_query($link, $query)) {
            $alert = '<p>registrado </p>';
            $status = true;
            aler($alert,$status);
         } else {
            $alert = '<p>intentelo de nuevo por favor</p>';
            $status = false;
            aler($alert,$status);
         }
      }
   }
}

if (array_key_exists("emaillog", $_POST) or array_key_exists("clave", $_POST)) {
   $link = mysqli_connect("127.0.0.1", "root", "", "sql");

   if (mysqli_connect_error()) {
      die("there was an error connecting to database.");
   } else {
      $query = "SELECT correo FROM login WHERE correo = '"
         . mysqli_real_escape_string($link, $_POST['emaillog']) . "'";

      $result = mysqli_query($link, $query);

      if (mysqli_num_rows($result) > 0) {
         $query = "SELECT password FROM login WHERE correo ='" .
            mysqli_real_escape_string($link, $_POST['emaillog']) . "'";

         $result = mysqli_query($link, $query);

         $pass = mysqli_fetch_array($result);

         if (password_verify($_POST['clave'], $pass[0])) {
            session_start();
            $_SESSION['user'] = $_POST['emaillog'];
            if($_POST["stay"]){
               setcookie("id", $_SESSION["user"], time() + 60 * 60 * 24 * 365);

            }
            header("location: pag.php");
            
         } else {
            $alert = "<p>Contraseña incorrecta</p>";
            $status = false;
            aler($alert,$status);
         }
      } else {
         $alert = "<p>Su correo aun no ha sido registrado</p>";
         $status = false;
         aler($alert,$status);
      }
   }
}


// $update = "UPDATE login SET password ='shit' WHERE id = '2' LIMIT 1";


?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="http://localhost/sql/bootstrap.css" type="text/css">
   <script src="jquery.js" type="text/javascript"></script>
   <title>My diario</title>
   <link rel="stylesheet" href="css/Sdiary.css">
</head>

<body class="container" >

<h1 class="text-center col-4">Mi diario secreto</h1>
   
   <div class="row text-center">
      <div class="col"></div>
      <div class="col">
         <form action="" name="reg" method="post" id="reg" class="form-control mt-4 pb-3">
            <label for="email">Correo</label>
            <input class="form-control" type="email" name="email" id="email" required>

            <label for="password">Contraseña</label>
            <input class="form-control" type="password" name="password" id="password" required>
            <br><br>
            <input class="btn btn-light col-4 " type="submit" value="registrar" class="btn">

         </form>
         
      </div>
      <div class="col"></div>
   </div>



   <div class="row text-center">
      <div class="col"></div>
      <div class="col">
         <form action="" name="log" method="post" id="log" class="form-control mt-4 pb-3">
            <label for="emaillog">Correo</label>
            <input class="form-control" type="email" name="emaillog" id="emaillog" required>

            <label for="clave">Contraseña</label>
            <input class="form-control" type="password" name="clave" id="clave" required>
            <input type="checkbox" name="stay" id="" class="me-2"><label for="stay"> Mantener sesion</label>
            <br><br>
            <input class="btn btn-light col-4" type="submit" value="ingresar" class="btn">

         </form>
         <br>
         <button class="btn btn-primary" id="cambio">registrarse</button>
      </div>
      <div class="col"></div>
   </div>


   <script>
      var estatus = true;
      $("#cambio").click(function() {

         if (estatus == true) {
            estatus = false
            $("#cambio").html("ingresar");
            $("#reg").css("display", "block");
            $("#log").css("display", "none");

         } else {
            estatus = true
            $("#cambio").html("registrarse");
            $("#reg").css("display", "none");
            $("#log").css("display", "block");

         }

      });
   </script>
</body>

</html>