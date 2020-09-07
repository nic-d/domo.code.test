<?php

namespace App\Domain\Chat\Controllers\Channel;

use Illuminate\Http\Request;
use App\Domain\Chat\Models\Channel;
use Illuminate\Validation\ValidationException;
use App\Domain\Infrastructure\Controllers\Controller;
use App\Domain\Chat\Resources\Channel\ChannelResource;

class UpdateController extends Controller
{
    /**
     * @param Request $request
     * @param Channel $channel
     * @return ChannelResource
     * @throws ValidationException
     */
    public function __invoke(Request $request, Channel $channel) : ChannelResource
    {
        $this->validate($request, [
            'name' => ['sometimes', 'string', 'min:3', 'max:250'],
            'description' => ['sometimes', 'nullable', 'max:250'],
        ]);

        $channel->update([
            'name' => $request->input('name', $channel->name),
            'description' => $request->input('description', $channel->description),
        ]);

        return new ChannelResource($channel);
    }
}
