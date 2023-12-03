<?php

const TEST_FILE = "day_03_test.txt"; // 4361
const FILE = "day_03.txt"; // 530849

function check(string $char): bool
{
    return !ctype_alpha($char) && !is_numeric($char) && $char != ".";
}

const SQUARE_TO_EXPLORE = [
    [0, 1],
    [0, -1],
    [1, 0],
    [-1, 0],
    [1, 1],
    [-1, -1],
    [-1, 1],
    [1, -1],
];

function explore_surrounding_squares($file, $explore_squares)
{
    foreach ($explore_squares as $point) {
        $y = $point[0];
        $x = $point[1];

        foreach (SQUARE_TO_EXPLORE as $coor) {
            try {
                // Validate array bounds before accessing
                if (isset($file[$y - $coor[0]][$x - $coor[1]]) && check($file[$y - $coor[0]][$x - $coor[1]])) {
                    return true;
                }
            } catch (Exception $e) {
                continue;
            }
        }
    }
    return false;
}

function main()
{
    $file = file(FILE);

    foreach ($file as $index => $line) {
        $file[$index] = str_split(trim($line));
    }

    $total = 0;

    foreach ($file as $y => $line) {
        $collecting_number = "";
        $explore_squares = [];
        foreach ($line as $x => $char) {

            $current_number = is_numeric(trim($char));

            if ($current_number) {
                $collecting_number = trim($collecting_number . $char);
                $explore_squares[] = [$y, $x];
            }

            if ($x === count($line) - 1 && $collecting_number != "") {
                if (explore_surrounding_squares($file, $explore_squares)) {
                    $total += (int) $collecting_number;
                }
                $collecting_number = "";
                $explore_squares = [];
                continue;
            }

            if (!is_numeric($char) && $collecting_number != "" && !$current_number) {
                if (explore_surrounding_squares($file, $explore_squares)) {

                    $total += (int) $collecting_number;
                    $collecting_number = "";
                    $explore_squares = [];
                }
                $collecting_number = "";
                $explore_squares = [];
            }
        }
    }
    print_r("\n" . $total . "\n");
}

main();
