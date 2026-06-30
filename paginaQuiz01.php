<?php
session_start();


$paises_mundo = [
    "España" => "https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/1f1ea-1f1e6.svg",
    "Alemania" => "https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/1f1e9-1f1ea.svg",
    "Haiti" => "https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/1f1ed-1f1f9.svg",
    "Albania" => "https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/1f1e6-1f1f1.svg",
    "Brasil" => "https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/1f1e7-1f1f7.svg",
    "Macedonia" => "https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/1f1f2-1f1f0.svg",
    "China" => "https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/1f1e8-1f1f3.svg",
    "Jamaica" => "https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/1f1ef-1f1f2.svg",
    "Mexico" => "https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/1f1f2-1f1fd.svg",
    "Italia" => "https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/1f1ee-1f1f9.svg",
    "Croacia" => "https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/1f1ed-1f1f7.svg",
    "Japon" => "https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/1f1ef-1f1f5.svg",
    "Turquía" => "https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/1f1f9-1f1f7.svg",
    "Portugal" => "https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/1f1f5-1f1f9.svg",
    "Corea del Sur" => "https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/1f1f0-1f1f7.svg",
    "Estados Unidos" => "https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/1f1fa-1f1f2.svg",
];

if (isset($_POST['usuario'])) {
    $_SESSION["usuario"] = $_POST['usuario'];
    $_SESSION["contador"] = 1;
    $_SESSION["puntos"] = 0;
    $_SESSION["pais_random"] = array_rand($paises_mundo);
}

if($_SESSION["contador"] >= 5) {
    header("Location: finalQuizBanderas.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['pais'])) {
    $pais_elegido = $_POST['pais'];

    $pais_correcto = $_SESSION["pais_random"];

    if ($pais_elegido == $pais_correcto) {
        $_SESSION["puntos"] += 10;
    } else {
        $_SESSION["puntos"] -= 5;
    }

    $_SESSION["contador"] += 1;

    $_SESSION["pais_random"] = array_rand($paises_mundo);
}

$pais_actual_pantalla = $_SESSION["pais_random"];
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>
    <link rel="stylesheet" href="stylesJuegosBanderas.css">
</head>
<body>
    <div class="contenedor-banderas">

        <div class="cabecera">
            <span>Usuario: <span style="color: orange"><?php echo $_SESSION["usuario"]?></span></span>
            <span>Pregunta: <span style="color: orange"><?php echo $_SESSION["contador"]?>/5</span></span>
            <span>Puntos: <span style="color: orange"><?php echo $_SESSION["puntos"] . "pts"?></span></span>
        </div>

        <h1 style="text-align: center; color:rgb(206, 203, 207)">Que bandera es de este pais:</h1>
        <h1 style="text-align: center; color:orange" class="pais"> <?php echo $pais_actual_pantalla?></h1>

        <form action="" method="POST">

        <div class="plantilla-banderas">

            <?php 
            
            foreach($paises_mundo as $nombre_pais => $imagen) {
                echo "<button type='submit' class='boton-pais' name='pais' value='$nombre_pais'><img src='$imagen'></button>";
            }
            
            ?>


        </div>
        </form>
    </div>
</body>
</html>

