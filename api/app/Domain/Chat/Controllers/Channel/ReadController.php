<?php

namespace App\Domain\Chat\Controllers\Channel;

use Illuminate\Http\Request;
use App\Domain\Chat\Models\Channel;
use App\Domain\Infrastructure\Controllers\Controller;
use App\Domain\Chat\Resources\Channel\ChannelResource;

class ReadController extends Controller
{
    /**
     * @param Request $request
     * @param Channel $channel
     * @return ChannelResource
     */
    public function __invoke(Request $request, Channel $channel) : ChannelResource
    {
        return new ChannelResource($channel);
    }
}
