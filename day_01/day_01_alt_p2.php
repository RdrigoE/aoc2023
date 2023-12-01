<?php

$replacementPairs = [
    'zero'  => 0,
    'one'   => 1,
    'two'   => 2,
    'three' => 3,
    'four'  => 4,
    'five'  => 5,
    'six'   => 6,
    'seven' => 7,
    'eight' => 8,
    'nine'  => 9,
];

// Define a custom comparison function
function sortByLength($a, $b)
{
    return strlen($b) - strlen($a);
}

// Sort the array by the length of its keys
uksort($replacementPairs, 'sortByLength');

const TEST_FILE = "day_01_alt.txt";
const PUZZLE_FILE = "day_01.txt";

$total = 0;

$f = fopen(PUZZLE_FILE, 'r');

if (!$f) {
    return;
}

function is_number($string, $number, int $string_index)
{
    $current_char = $string[$string_index];
    if ($current_char == $number[0] && count($string) - $string_index >= count($number)) {

        foreach ($number as $index => $value) {

            if ($string[$string_index + $index] != $number[$index]) {
                break;
            }

            if ($index == count($number) - 1) {
                return true;
            }
        }
    }
    return false;
}

function generate_numbers(string $string, mixed $replacementPairs)
{
    $numbers = "";
    $string = str_split($string);
    foreach ($string as $string_index => $char) {
        if (is_numeric($char)) {
            $numbers = $numbers . (string) $char;
        }

        foreach ($replacementPairs as $key => $value) {
            $key = str_split($key);

            if (is_number($string, $key, $string_index)) {
                $numbers = $numbers . (string)  $value;
            }
        }
    }
    return $numbers;
}

while (!feof($f)) {
    $line = generate_numbers(fgets($f), $replacementPairs);
    preg_match_all('!\d!', $line, $matches);
    if (count($matches[0]) > 0) {
        $first = $matches[0][0];
        $last = end($matches[0]);
        $total += intval($first . $last);
    }
}

fclose($f);

print_r($total);
