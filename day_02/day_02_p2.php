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


function main()
{
    $file = file(FILE);
    $total = 0;
    foreach ($file as $line) {
        $game = new Game($line);
        $total += $game->red * $game->green * $game->blue;
    }

    print_r($total);
}

main();
