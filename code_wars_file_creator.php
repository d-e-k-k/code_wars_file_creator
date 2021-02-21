<?php


// API GET REQUREST

$ch = curl_init();

$url = "https://www.codewars.com/api/v1/code-challenges/54521e9ec8e60bc4de000d6c";


curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$resp = curl_exec($ch);

if ($e = curl_error($ch)) {
    echo $e;
} else {
    $decode = json_decode($resp);
}
curl_close($ch);

//FILE AND OR DIRECTORY CREATION

define("DS", DIRECTORY_SEPARATOR);

$dirName = str_replace("-", "_", $decode->slug);
$fileName = $dirName . ".php";
$rank = abs($decode->rank->id);

$rankPath = "/home/david/sei/code_challenges/code_wars/" . $rank . "kyu";




if (!is_dir($rankPath)) {
    mkdir($rankPath);
}

if (!is_dir($rankPath . DS . $dirName)) {
    mkdir($rankPath . DS . $dirName);
}

if(!is_file($rankPath . DS . $dirName . DS . $fileName)){
    touch($rankPath . DS . $dirName . DS . $fileName);
    echo "File created at: " . $rankPath . DS . $dirName . $fileName . "\n";
}else{
    echo '"' .$fileName. '" already exists at ' . $rankPath . DS . $dirName . "\n"; 
