<?php

const TEST_FILE = "day_03_test.txt"; // 4361
const FILE = "day_03.txt"; // 78634878 low

function is_asktric($char)
{
    return "*" == $char;
}

function get_numbers($line)
{
    preg_match_all('/\d+/', implode($line), $m, PREG_OFFSET_CAPTURE); // Fix: Use proper regex delimiters and fix the regex pattern
    return $m;
}

function process_line($line, $x)
{

    $matches = [];
    $numbers = get_numbers($line)[0];

    foreach ($numbers as $value) {
        $n = $value[0];
        $idx = $value[1];
        if (($x - 1 <= $idx + strlen($n) - 1) && $idx + strlen($n) - 1 <= $x + 1 || ($x - 1 <= $idx) &&  $idx <= $x + 1) {
            $matches[] = (int) $n;
        }
    }

    return $matches;
}

function analyse_3_lines($file, $point): mixed
{
    $y = $point[0];
    $x = $point[1];

    $matches = [];
    $matches[] = process_line($file[$y], $x);

    if ($y != 0) {
        $matches[] = process_line($file[$y - 1], $x);
    }
    if ($y != count($file) - 1) {
        $matches[] = process_line($file[$y + 1], $x);
    }
    return array_merge(...$matches);
}

function main()
{
    $file = file(FILE);

    foreach ($file as $index => $line) {
        $file[$index] = str_split(trim($line));
    }

    $total = 0;

    foreach ($file as $y => $line) {
        foreach ($line as $x => $char) {
            if (is_asktric(trim($char))) {
                $matches = analyse_3_lines($file, [$y, $x]);
                if (count($matches) == 2) {
                    $total += $matches[0] * $matches[1];
                }
            };
        }
    }
    print_r("\n" . $total . "\n");
}

main();
