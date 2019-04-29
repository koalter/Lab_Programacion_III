<?php

$_PUT = array();
$_DELETE = array();
$content = file_get_contents("php://input");
//var_dump($content);

switch ($_SERVER['REQUEST_METHOD'])
{
    case 'PUT':
        parse_str($content, $_PUT);
        var_dump($_PUT);
        break;
    case 'DELETE':
        parse_str($content, $_DELETE);
        var_dump($_DELETE);
        break;
}
?>