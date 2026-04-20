<?php

function encode($string,$key) {
    $hash="";
    $j=0;
$key = sha1($key);
$strLen = strlen($string);
$keyLen = strlen($key);
for ($i = 0; $i < $strLen; $i++) {
$ordStr = ord(substr($string,$i,1));
if ($j == $keyLen) { $j = 0; }
$ordKey = ord(substr($key,$j,1));
$j++;
$hash .= strrev(base_convert(dechex($ordStr + $ordKey),16,36));
}
return $hash;
}