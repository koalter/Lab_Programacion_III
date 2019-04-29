<?php
include_once '../Clases/Alumno.php';
var_dump($_FILES);

if ($_FILES != null) {
    $alumno = new Alumno($_POST['apellido'], $_POST['legajo']);
    $origen = $_FILES['foto']['tmp_name'];
    //TODO: hacer un chequeo de la extension para asegurarse que solo sea jpg o png
    $filename = $alumno->legajo.$alumno->apellido;
    $destino = '../Fotos/'.$filename.'.'.pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);

    if (file_exists($destino)) {
        //codigo para realizar el backup
        $backupPath = '../FotosBackup/'.$filename.date('(d-m-y)', time()).'.'.pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        if (!file_exists('../FotosBackup/'))
        {
            mkdir('../FotosBackup/');
        }
        $backup = rename($destino, $backupPath);
        
        if ($backup) {
            echo "<p>Se hizo un backup del archivo</p>";
        }
    }
    $return = move_uploaded_file($origen, $destino);

    if ($return) {
        echo "<p>El archivo se movio a Fotos</p>";
    }
}
else
{
    echo "Para empezar, suba un archivo con el metodo POST usando key=foto";
}

?>