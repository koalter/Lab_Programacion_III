<?php

if ($_SERVER['REQUEST_METHOD'] != 'PUT')
{
    echo 'Esto funciona con el metodo PUT';
}
else 
{
    echo 'Estas usando el metodo PUT, muy bien!';
}

?>