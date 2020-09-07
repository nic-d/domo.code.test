<?php

namespace App\Domain\Chat\Controllers\Channel;

use Illuminate\Http\Request;
use App\Domain\Chat\Models\Channel;
use Illuminate\Validation\ValidationException;
use App\Domain\Infrastructure\Controllers\Controller;
use App\Domain\Chat\Resources\Channel\ChannelResource;

class CreateController extends Controller
{
    /**
     * @param Request $request
     * @return ChannelResource
     * @throws ValidationException
     */
    public function __invoke(Request $request) : ChannelResource
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'min:3', 'max:250'],
            'description' => ['sometimes', 'nullable', 'max:250'],
        ]);

        $channel = Channel::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        return new ChannelResource($channel);
    }
}
