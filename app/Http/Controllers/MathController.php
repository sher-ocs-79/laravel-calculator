<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ExpressionEvaluationService;

class MathController extends Controller
{
    protected $expressionEvaluationService;

    public function __construct(ExpressionEvaluationService $expressionEvaluationService)
    {
        $this->expressionEvaluationService = $expressionEvaluationService;
    }

    public function evaluate(Request $request)
    {
        // Get the input expression from query parameters
        $input = $request->query('expression', '1 + 2 * 3 - 4 / 5');

        // Use the service to evaluate the expression
        $result = $this->expressionEvaluationService->evaluate($input);

        return response()->json([
            'expression' => $input,
            'result' => $result
        ]);
    }
}
