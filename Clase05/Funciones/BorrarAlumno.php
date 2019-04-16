<?php

if ($_SERVER['REQUEST_METHOD'] != "DELETE")
{
    echo 'Esto funciona con el metodo DELETE';
}
else 
{
    echo 'Estas usando el metodo DELETE, muy bien!';
}

?>