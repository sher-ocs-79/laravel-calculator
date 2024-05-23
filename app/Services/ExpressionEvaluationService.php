<?php

namespace App\Services;

use App\Helpers\MathHelper;

class ExpressionEvaluationService
{
    public function evaluate($expression)
    {
        // Remove spaces from the expression
        $expression = str_replace(' ', '', $expression);

        // Define operator precedence and functions
        $precedence = [
            '+' => 1,
            '-' => 1,
            '*' => 2,
            '/' => 2,
            'sqrt' => 3
        ];

        $operators = ['+', '-', '*', '/', 'sqrt'];

        // Two stacks: one for numbers and one for operators
        $numbers = [];
        $ops = [];

        // Process the expression character by character
        $i = 0;
        while ($i < strlen($expression)) {
            // If we encounter 'sqrt'
            if (substr($expression, $i, 4) == 'sqrt') {
                array_push($ops, 'sqrt');
                $i += 4;
                continue;
            }

            $char = $expression[$i];

            // If the character is a number, parse the full number
            if (is_numeric($char) || $char == '.') {
                $num = '';
                while ($i < strlen($expression) && (is_numeric($expression[$i]) || $expression[$i] == '.')) {
                    $num .= $expression[$i];
                    $i++;
                }
                array_push($numbers, floatval($num));
                continue;
            }

            // If the character is an operator
            if (in_array($char, $operators)) {
                while (!empty($ops) && $precedence[end($ops)] >= $precedence[$char]) {
                    MathHelper::applyOperator($numbers, array_pop($ops));
                }
                array_push($ops, $char);
            }

            $i++;
        }

        // Apply remaining operators
        while (!empty($ops)) {
            MathHelper::applyOperator($numbers, array_pop($ops));
        }

        // The result should be the only number left in the stack
        return array_pop($numbers);
    }
}
