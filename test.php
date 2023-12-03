<?php
function check(string $char): bool
{
    return !ctype_alpha($char) && !is_numeric($char) && $char != ".";
}

echo (bool) check("x");
