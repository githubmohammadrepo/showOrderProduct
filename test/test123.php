<?php

$name = 'mohammad';
$sql = <<<Demo

\'$name\'

Demo;

echo stripslashes($sql);

?>