<pre>
<?php

require "../classes/customString.php";

$string = file_get_contents('string.txt');

$CustomString = new customString($string);
$CustomString->filterWithout(["de", "het", "een", "te"]);

var_dump($CustomString->getFrequentyTable());
var_dump($CustomString->getUsers());

?>
</pre>