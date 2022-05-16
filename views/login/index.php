<?php
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="assets/css/login.css">

    <!-- <link rel="stylesheet" type="text/css" href="../assets/css/login.css"> -->


    <title>Login</title>
</head>

<body>
    <div class="contenedor">
        <div class="side-izquierdo">
            <div class="titulos">
                <h4>Universidad de cordoba</h4>
                <h1>Sistema de gestion de actas</h1>
                <div class="img-login" style="background-image: url(assets/img/Universiordoba_Colombia.svg.png)"></div>
            </div>
        </div>
        <div class="side-derecho">
            <div class="header">
                <p>Bienvenido de nuevo</p>
                <h2>Ingrese a su cuenta</h2>
            </div>
            <form action="<?php echo constant('URL'); ?>login/authenticate" method="POST">
                <div class="input-contenedor">
                    <i class=""></i>
                    <input type="text" placeholder="Usuario" name="usuario" id="usuario">
                    <i class=""></i>
                    <input type="password" placeholder="Contraseña" name="contraseña" id="contraseña">
                    <button type="submit" class="btn">Iniciar sesion ahora</button>
                    <p>No tiene una cuenta? <span> <a href="">Solicita una</a> </span></p>
                </div>
            </form>
        </div>
    </div>
</body>

</html>