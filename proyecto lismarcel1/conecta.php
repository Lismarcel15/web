<?php
include('cone.php');
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$evento=$_POST['evento'];
$servicio = $_POST['servicio'];
$costo=$_POST['precio'];
$fecha = $_POST['fecha'];
$invitados = $_POST['invitados'];
$mensaje = $_POST['mensaje'];
$consulta = "INSERT INTO datos (nombre, email, telefono, evento,Precio, servicio, fecha, invitados, mensaje)
        VALUES ('$nombre', '$email', '$telefono', '$evento','$costo',' $servicio', '$fecha',' $invitados',' $mensaje')";
$resp=mysqli_query($conexion,$consulta);
header('location:index.html');