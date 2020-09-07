<?php

namespace App\Domain\Chat\Controllers\Account\Channel;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Domain\Chat\Models\Channel;
use App\Domain\Infrastructure\Models\User;
use Illuminate\Validation\ValidationException;
use App\Domain\Infrastructure\Controllers\Controller;
use App\Domain\Infrastructure\Resources\User\UserResource;

class UpdateController extends Controller
{
    /**
     * @param Request $request
     * @return UserResource|JsonResponse
     * @throws ValidationException
     */
    public function __invoke(Request $request)
    {
        $this->validate($request, [
            'channel' => ['required', 'exists:channels,uuid'],
        ]);

        /** @var User $user */
        $user = $request->user();

        /** @var Channel|null $channel */
        $channel = Channel::where('uuid', $request->input('channel'))->first();

        if (! $channel instanceof Channel) {
            return response()->json([
                'error' => true,
                'message' => 'Could not find channel',
            ]);
        }

        $user->update([
            'channel_id' => $channel->id,
        ]);

        return new UserResource($user);
    }
}
