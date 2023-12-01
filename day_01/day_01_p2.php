<?php

// On each line, the calibration value can be found by 
// combining the first digit and the last digit (in that order)
// to form a single two-digit number.
const TEST_FILE = "day_01_test_p2.txt"; // 142
const FILE = "day_01.txt";

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
}

function get_first_number(string $string, $numbers, bool $reversed = false)
{
    $string = str_split($string);

    if ($reversed) {
        $string = array_reverse($string);
    }

    foreach ($string as $string_index => $char) {
        if (is_numeric($char)) {
            return $char;
        }

        foreach ($numbers as $j => $number) {
            $number = str_split($number);

            if ($reversed) {
                $number = array_reverse($number);
            }

            if (is_number($string, $number, string_index: $string_index)) {
                return (string) $j + 1;
            }
        }
    }
}

function get_number(string $line, $numbers): int
{
    return (int) (get_first_number(string: $line, numbers: $numbers) . get_first_number(string: $line, numbers: $numbers, reversed: true));
}

function main()
{

    $file = file(FILE);

    $numbers = ["one", "two", "three", "four", "five", "six", "seven", "eight", "nine",];
    $solution = [];

    foreach ($file as $line) {
        $value = get_number($line, $numbers);
        $solution[] = $value;
    }

    echo array_sum($solution);
}

main();
