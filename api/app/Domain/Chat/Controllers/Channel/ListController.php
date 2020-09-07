<?php

namespace App\Domain\Chat\Controllers\Channel;

use Illuminate\Http\Request;
use App\Domain\Chat\Models\Channel;
use App\Domain\Infrastructure\Controllers\Controller;
use App\Domain\Chat\Resources\Channel\ChannelResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ListController extends Controller
{
    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function __invoke(Request $request) : AnonymousResourceCollection
    {
        $channels = Channel::orderBy('name', 'asc')->get();
        return ChannelResource::collection($channels);
    }
}
