<?php

namespace App\Domain\Chat\Controllers\Channel\Message;

use Illuminate\Http\Request;
use App\Domain\Chat\Models\Channel;
use App\Domain\Infrastructure\Controllers\Controller;
use App\Domain\Chat\Resources\Message\MessageResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ListController extends Controller
{
    /**
     * @param Request $request
     * @param Channel $channel
     * @return AnonymousResourceCollection
     */
    public function __invoke(Request $request, Channel $channel)
    {
        $messages = $channel
            ->messages()
            ->orderByDesc('created_at')
            ->paginate(50)
        ;

        return MessageResource::collection($messages);
    }
}
