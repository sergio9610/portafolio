<?php
session_start();

if (isset($_SESSION['usuario'])!='develoteca') {
    header('login.php');
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portafolio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

</head>
<body>
    
    <div class="container">
        
        <a href="index.php">Inicio</a> |
        <a href="portafolio.php">Portafolio</a> |
        <a href="login.php">Login</a> |
        <a href="cerrar.php">Cerrar</a> 
        <br>
    
    