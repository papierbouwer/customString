<?php

require "./classes/customString.php";

$string = file_get_contents('./data/string.txt');

$CustomString = new customString($string);
$frequenty = $CustomString->filterWithout([""])->getFrequentyTableJSON();

header('Content-Type: application/json');
echo $frequenty;

?>