<?php
echo pathinfo($_FILES['fichero_usuario']['name'], PATHINFO_EXTENSION);
?>