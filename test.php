<?php

ini_set('display_errors', 'On');
error_reporting(E_ALL);

$srcText = tmpfile();
//$srcText = fopen("srcTemp", "r+");
$headerText = tmpfile();
//$headerText = fopen("headerTemp", "r+");
$curlHandle = curl_init();
$header = "";
$source = "";

curl_setopt($curlHandle, CURLOPT_URL, "localhost/wordpress");
curl_setopt($curlHandle, CURLOPT_CERTINFO, 1);
curl_setopt($curlHandle, CURLOPT_VERBOSE, 1);
curl_setopt($curlHandle, CURLOPT_STDERR, $headerText);
curl_setopt($curlHandle, CURLOPT_FILE, $srcText);
curl_exec($curlHandle);

// Set $header to the verbose output returned by curl_exec
fseek($headerText, 0);
while(strlen($header .= fread($headerText, 8192)) == 8192);
// $header now contains header information for the curl
// operation that can be parsed to get size and load time

// Store the html source code in $source
fseek($srcText, 0);
while(strlen($source .= fread($srcText, 8192)) == 8192);

echo $source;

?>
