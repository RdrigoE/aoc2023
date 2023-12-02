<?php

const TEST_FILE = "day_02_test.txt"; // 8
const FILE = "day_02.txt";

class Game
{
    public int $red;
    public int $green;
    public int $blue;
    public int $gameId;

    public function __construct(string $line)
    {

        $this->red = 0;
        $this->green = 0;
        $this->blue = 0;
        $this->process_line($line);
    }

    private function process_line($line)
    {
        $game_state = explode(": ", $line);

        $game = $game_state[0];
        $state = $game_state[1];

        $this->gameId = (int) explode(" ", $game)[1];

        $game_sets = explode("; ", $state);

        foreach ($game_sets as $game_set) {
            $sets = explode(", ", $game_set);
            foreach ($sets as $set) {
                $state = explode(" ", $set);
                $this->update_color(trim($state[1]), (int) $state[0]);
            }
        }
    }
    private function update_color(string $color, int $value): void
    {
        if ($color === "red" && $this->red < $value) {
            $this->red = $value;
        } else if ($color === "green" && $this->green < $value) {
            $this->green = $value;
        } else if ($color === "blue" && $this->blue < $value) {
            $this->blue = $value;
        }
    }
}


const MAX_RED = 12;
const MAX_GREEN = 13;
const MAX_BLUE = 14;
function main()
{
    $file = file(FILE);
    $total = 0;
    foreach ($file as $line) {
        $game = new Game($line);
        if ($game->red <= MAX_RED && $game->green <= MAX_GREEN && $game->blue <= MAX_BLUE) {
            $total += $game->gameId;
        }
    }

    print_r($total);
}

main();

// $line = "Game 56: 3 blue, 13 green; 9 green, 2 blue; 1 red, 2 blue, 16 green";
// $game = new Game($line);
// print_r($game);
// if ($game->red <= MAX_RED && $game->green <= MAX_GREEN && $game->blue <= MAX_BLUE) {
//     print_r($game->gameId . "\t");
// //     $total += $game->gameId;
// }
