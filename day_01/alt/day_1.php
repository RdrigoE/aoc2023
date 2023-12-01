<?php

$filename = "puzzle.txt";
$total = 0;

$f = fopen($filename, 'r');

if (!$f) {
    return;
}

while (!feof($f)) {
    $line = fgets($f);
    preg_match_all('!\d!', $line, $matches);
    if (count($matches[0]) > 0) {
        $first = $matches[0][0];
        $last = end($matches[0]);
        $total += $first + $last;
    }
}

fclose($f);

print_r($total);
