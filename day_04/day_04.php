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
                    if ($matches == 0) {
                        $matches = 1;
                    } else {
                        $matches *= 2;
                    }
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

    foreach ($file as $line) {
        $g = new Game($line);
        $total = $total + $g->matches();
    }
    print_r("The total is " . $total . "\n");
}

main();
