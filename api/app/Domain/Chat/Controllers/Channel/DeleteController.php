<?php

namespace App\Domain\Chat\Controllers\Channel;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Domain\Chat\Models\Channel;
use App\Domain\Infrastructure\Controllers\Controller;

class DeleteController extends Controller
{
    /**
     * @param Request $request
     * @param Channel $channel
     * @return JsonResponse
     * @throws Exception
     */
    public function __invoke(Request $request, Channel $channel) : JsonResponse
    {
        $channel->delete();

        return response()->json([
            'success' => true,
        ]);
    }
}
