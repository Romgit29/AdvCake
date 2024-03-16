<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReverseStringRequest;
use App\Actions\ReverseStringAction;

class ReverseStringController
{
    public function __invoke(ReverseStringRequest $request, ReverseStringAction $publishPostAction)
    {
        $result = $publishPostAction->execute($request->string);
        return response()->json([
            'success' => true,
            'result' => $result
        ]);
    }
}
