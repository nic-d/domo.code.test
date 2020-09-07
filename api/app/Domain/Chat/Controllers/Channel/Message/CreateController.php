<?php

namespace App\Domain\Chat\Controllers\Channel\Message;

use Illuminate\Http\Request;
use App\Domain\Chat\Models\Channel;
use App\Domain\Chat\Models\Message;
use Illuminate\Validation\ValidationException;
use App\Domain\Chat\Events\Message\CreateEvent;
use App\Domain\Infrastructure\Controllers\Controller;
use App\Domain\Chat\Resources\Message\MessageResource;

class CreateController extends Controller
{
    /**
     * @param Request $request
     * @param Channel $channel
     * @return MessageResource
     * @throws ValidationException
     */
    public function __invoke(Request $request, Channel $channel) : MessageResource
    {
        $this->validate($request, [
            'message' => ['required', 'string', 'min:1', 'max:500'],
        ]);

        /** @var Message $message */
        $message = $channel
            ->messages()
            ->create([
                'user_id' => $request->user()->id,
                'message' => $request->input('message'),
            ])
        ;

        event(new CreateEvent($request, $request->user(), $message));

        return new MessageResource($message);
    }
}
