<?php

// On each line, the calibration value can be found by 
// combining the first digit and the last digit (in that order)
// to form a single two-digit number.
const TEST_FILE = "day_01_test.txt"; // 142
const FILE = "day_01.txt";

/**
 * Returns the first numeric number or the first spelled out number
 * 
 * @param string $string
 * @param boolean $reversed
 * @return string
 */
function get_first_number(string $string, bool $reversed = false): string
{
    $string = str_split($string);

    if ($reversed) {
        $string = array_reverse($string);
    }

    foreach ($string as $char) {
        if (is_numeric($char)) {
            return $char;
        }
    }
}

/**
 * get_number
 * @param string $line
 * @return integer
 */
function get_number(string $line): int
{
    return (int) (get_first_number(string: $line, reversed: false) . get_first_number(string: $line, reversed: true));
}


function main()
{

    $file = file(FILE);

    $solution = [];

    foreach ($file as $line) {
        $value = get_number($line);
        $solution[] = $value;
    }

    echo array_sum($solution);
}

main();
