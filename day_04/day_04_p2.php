<?php

const TEST_FILE = "day_04_test.txt";
const FILE = "day_04.txt";


class Game
{
    public $original;
    public $guess;
    public $id;

    public function __construct($line)
    {
        $this->process_line($line);
    }

    private function process_line($line)
    {
        $game = explode(":", $line);

        $splited = explode(" ", $game[0]);
        $lastIndex = count($splited) - 1;
        $this->id = (int) trim($splited[$lastIndex]);

        $numbers = explode("|", $game[1]);

        $originals = explode(" ", trim($numbers[0]));
        $guesses = explode(" ", trim($numbers[1]));

        foreach ($originals as $number) {
            $number = trim($number);
            if (is_numeric($number)) {
                $this->original[] = (int) trim($number);
            }
        }
        foreach ($guesses as $number) {
            $number = trim($number);
            if (is_numeric($number)) {
                $this->guess[] = (int) trim($number);
            }
        }
    }

    public function matches()
    {
        $matches = 0;
        foreach ($this->original as $og) {
            foreach ($this->guess as $guess) {
                if ($og === $guess) {
                    $matches += 1;
                }
            }
        }
        return $matches;
    }
}


function main()
{
    $file = file(FILE);

    foreach ($file as $index => $line) {
        $file[$index] = trim($line);
    }

    $total = 0;
    $multiply_array = [1 => 1];

    foreach ($file as $line) {
        $g = new Game($line);
        $matches = $g->matches();

        if (!isset($multiply_array[$g->id])) {
            $multiply_array[$g->id] = 1;
        }

        for ($j = 0; $j < $multiply_array[$g->id]; $j++) {
            for ($i = $g->id + 1; $i < $g->id + $matches + 1; $i++) {
                $multiply_array[$i] = isset($multiply_array[$i]) ? $multiply_array[$i] + 1 : 2;
            }
        }
    }

    $total = array_sum($multiply_array);
    print_r("The total is " . $total . "\n");
}

main();
