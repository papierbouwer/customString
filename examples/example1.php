<pre>
<?php

require "../classes/customString.php";

$string = "Morgen te gast in #MolTalk: @msandifort, @MarcMarieH en Chris Zegers! #widm https:\/\/t.co\/UmqOdqjpwq";
$string2 = "RT @WieIsDeMol: Weet jij wie de Mol is en wil je zaterdag in #MolTalk je theorie toelichten? Ga naar: https:\/\/t.co\/rOTA1WyHHp #widm https:\/\u2026";
$string3 = "Klaar voor de finale van wie is de mol 2016 #widm #jokers #moltalk #3dprinting #diy #zelfg\u2026 https:\/\/t.co\/5eSIDfrXbU https:\/\/t.co\/pry6sM0L5E";

$CustomString = new customString($string2);
$CustomString->filterWithout([]);

var_dump($CustomString->getFrequentyTable());
var_dump($CustomString->getHashtags());
var_dump($CustomString->getUrls());
var_dump($CustomString->getUsers());

?>
</pre>