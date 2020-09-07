<?php

namespace App\Domain\Infrastructure\Controllers\Ping;

use Illuminate\Http\JsonResponse;
use App\Domain\Infrastructure\Controllers\Controller;

class ReadController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function __invoke() : JsonResponse
    {
        return response()->json([
            'ping' => 'pong',
        ]);
    }
}
