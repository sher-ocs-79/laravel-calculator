<?php

namespace Tests\Feature;

use Tests\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

class MathControllerTest extends TestCase
{
    /**
     * Data provider for testEvaluateExpression.
     *
     * @return array
     */
    public static function expressionProvider(): array
    {
        return [
            ['1+2*3-4/5', 6.2],
            ['10/2+3*4-5', 12.0],
            ['5*6/3+2-1', 11.0],
            ['4+18/2-3*2', 7.0],
            ['7-3+2*5/2', 9.0],
            ['sqrt4+2', 4.0],
            ['sqrt16+sqrt9*2', 10.0],
            ['10-sqrt9', 7.0],
        ];
    }

    /**
     * Test the evaluation of various mathematical expressions.
     *
     * @param string $expression
     * @param float $expectedResult
     * @return void
     */
    #[DataProvider('expressionProvider')]
    public function testEvaluateExpression(string $expression, float $expectedResult): void
    {
        $response = $this->get('/evaluate?expression=' . urlencode($expression));

        $response->assertStatus(200);
        $response->assertJson([
            'expression' => str_replace(' ', '', $expression), // Ensure spaces are stripped
            'result' => $expectedResult
        ]);
    }
}
