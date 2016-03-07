<?php

require "./classes/customString.php";

$string = file_get_contents('./data/string.txt');

$CustomString = new customString($string);
$CustomString->filterWithout([""]);

$frequenty = $CustomString->getFrequentieTable();

header('Content-Type: application/json');
echo json_encode($frequenty);

?>