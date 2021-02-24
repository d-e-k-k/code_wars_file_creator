#!/usr/bin/env php
<?php


// API GET REQUREST

if ($argc < 3) {
    echo "ERROR ARG: " . basename(getcwd()) . " requires two arguments, language by extension name and challenge id respectivly.\n";
    return;
}

$ch = curl_init();
$id = $argv[2];
$url = "https://www.codewars.com/api/v1/code-challenges/" . $id;


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

$langExt = $argv[1];
$dirName = str_replace("-", "_", $decode->slug);
$fileName = $dirName . "." . $langExt;
$rank = abs($decode->rank->id);

$rankPath = "/home/david/sei/coding_challanges/code_challenges/code_wars/" . $rank . "kyu";




if (!is_dir($rankPath)) {
    mkdir($rankPath);
}

// if (!is_dir($rankPath . DS . $dirName)) {
//     mkdir($rankPath . DS . $dirName);
// }

if (!is_file($rankPath . DS . $dirName . DS . $fileName)) {
    touch($rankPath . DS . $dirName . DS . $fileName);
    echo "File created at: " . $rankPath . DS . $dirName . DS . $fileName . "\n";
} else {
    echo '"' . $fileName . '" already exists at ' . $rankPath . DS . $dirName . "\n";
}

echo "Would you like to open this file?(y/n)\n";
$handle = fopen('php://stdin', 'r');
$line = fgets($handle);
if (trim($line) == 'y') {
    echo "Opening...\n";
    exec('code ' . $rankPath . DS . $dirName  . DS . $fileName);
} else {
    echo "Exiting...\n";
}
