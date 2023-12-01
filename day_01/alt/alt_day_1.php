<?php

$filename = "puzzle.txt";
$lines = [];

$f = fopen($filename, 'r');

if (!$f) {
    return;
}

while (!feof($f)) {
    $lines[] = fgets($f);
}

fclose($f);

$lines_nums = [];
$nums = [];

foreach ($lines as $line) {
    preg_match_all('!\d!', $line, $lines_nums[]);
}
foreach ($lines_nums as &$line_nums) {
    array_splice($line_nums[0], 1, -1);
    $nums[] = implode('', sizeof($line_nums[0]) == 1 ? array_merge($line_nums[0], $line_nums[0]) : $line_nums[0]);
}

$result = array_sum(array_filter($nums));

print_r($result);
