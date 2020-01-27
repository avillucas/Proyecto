<?php
$cons_usuario = "default";
$cons_contra = "secret";
$cons_base_datos = "default"; //nombrde de cada uno
$cons_equipo = "mysql";

$obj_conexion = mysqli_connect($cons_equipo,$cons_usuario,$cons_contra,$cons_base_datos);

$msg = "";
if (!$obj_conexion){
    echo "<h3>No se ha podido conectar PHP - MySQL, verifique sus datos.</h3><hr><br>";
        echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
        //echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
} else {
    $user = isset($_REQUEST['user']) ? $_REQUEST['user'] : NULL;
    $pass = isset($_REQUEST['pass']) ? $_REQUEST['pass'] : NULL;

    if (!is_null($user) && !is_null($pass)) {
            $sql = "SELECT * FROM ".$cons_base_datos.".users WHERE user_name = '".mysqli_real_escape_string($obj_conexion,$user)."' AND password = '".mysqli_real_escape_string($obj_conexion,$pass)."'";
            if ($select = mysqli_query($obj_conexion, $sql)) {
            $msg = "Hay datos... leer los datos";
        } else {
            $msg = "Problemas en el query: ".mysqli_error($obj_conexion);
        }
    } else {
        /* $msg = "Falta usuario y/o pass"; */
    }
}


mysqli_close ($obj_conexion);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">    <link rel="stylesheet" href="login.css">
    </head>
<body>
    <form action="#">
        <div class="row">
            <div class="col">
                <div class="log">
                <label for="user">Usuario<br><input type="text" name="user"  required></label>
                <br>
                <label for="pass">Contraseña<br><input type="password" name="pass" required></label>
                <br>
                <input type="submit" class="btn btn-primary btn-lg btn-block">
                </div>
            </div>
        </div>
        <?php echo $msg."<br>"; ?>
        <br>
        <div class="row">
            <div class="col">
                <p><a href="registro.php">Usuario nuevo</a></p>
                <p><a href="#">Olvidaste la contraseña</a></p>
            </div>
        </div>
    </form>


<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script></body>
</html>