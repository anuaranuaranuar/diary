<?php
session_start();
if(array_key_exists("id", $_COOKIE)){
    $_SESSION["user"] = $_COOKIE["id"];

}

echo "<h1 id='user' class='col-7' >bienvenido  " . $_SESSION['user'] . "</em></h1>";

if (array_key_exists('user', $_SESSION)) {
    $link = mysqli_connect("127.0.0.1", "root", "", "sql");

    if (mysqli_connect_error()) {
        die("there was an error connecting to database.");
    } else {
        $query = 'SELECT notas FROM login WHERE correo ="' . $_SESSION['user'] . '"';
        $result = mysqli_query($link, $query);
        $nota = mysqli_fetch_array($result);
    }
} 


if (array_key_exists("nota", $_POST)) {
    $nota[0] = $_POST["nota"];
    $query = "UPDATE login SET notas = '" . $_POST["nota"] . "' WHERE correo = '" . $_SESSION["user"] . "'";
    mysqli_query($link, $query);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/sql/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="css/Spag.css">
    <script src="jquery.js" type="text/javascript"></script>
    <title>My diario</title>
    <script>
    $("#cerrar").click(function(){
        var sesion = false
        
    }
    
    )

    </script>
    

</head>

<body class="container">
   
        

        <form action="" method="post" class="text center">
            <textarea name="nota" cols="122" rows="19" class="text"><?php echo $nota[0] ?></textarea>
            <br><br>
            <input type="submit" value="Guardar pensamientos" class="btn btn-primary me-5 ms-5">
            <button class="btn btn-primary me-5 " id="cerrar"><a href="logout.php">cerrar sesion</a></button>
        </form>

    

</body>

</html>