<?php
preg_match_all('/\d+/', '123..32..12*..1', $m, PREG_OFFSET_CAPTURE); // Fix: Use proper regex delimiters and fix the regex pattern

print_r($m);
