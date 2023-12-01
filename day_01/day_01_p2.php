<?php

// On each line, the calibration value can be found by 
// combining the first digit and the last digit (in that order)
// to form a single two-digit number.
const TEST_FILE = "day_01_test_p2.txt"; // 142
const FILE = "day_01.txt";

/**
 * is_number
 * 
 * Check if the string contains a number spelled out.
 *
 * @param array<string> $string
 * @param array<string> $number
 * @param integer $string_index
 * @return boolean
 */
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

/**
 * Returns the first numeric number or the first spelled out number
 * 
 * @param string $string
 * @param array<string> $numbers
 * @param boolean $reversed
 * @return string
 */
function get_first_number(string $string, $numbers, bool $reversed = false): string
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

/**
 * Extract the initial number (either numeric or spelled out) from a string 
 * in both forward and reverse order and creates an integer.
 * 
 * @param string $line
 * @param array<string> $numbers
 * @return integer
 */
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
