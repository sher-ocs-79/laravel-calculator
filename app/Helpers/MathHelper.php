<?php

namespace App\Helpers;

class MathHelper
{
    public static function applyOperator(&$numbers, $operator)
    {
        $b = array_pop($numbers);
        $a = array_pop($numbers);
        switch ($operator) {
            case '+':
                array_push($numbers, $a + $b);
                break;
            case '-':
                array_push($numbers, $a - $b);
                break;
            case '*':
                array_push($numbers, $a * $b);
                break;
            case '/':
                array_push($numbers, $a / $b);
                break;
        }
    }
}
