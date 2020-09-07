<?php

namespace App\Domain\Chat\Events\Message;

use Illuminate\Http\Request;
use App\Domain\Chat\Models\Message;
use Illuminate\Broadcasting\Channel;
use App\Domain\Infrastructure\Models\User;
use App\Domain\Infrastructure\Events\Event;
use Illuminate\Broadcasting\PrivateChannel;
use App\Domain\Chat\Resources\Message\MessageResource;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class CreateEvent extends Event implements ShouldBroadcastNow
{
    public Request $request;
    public User $user;
    public Message $message;

    /**
     * CreateEvent constructor.
     * @param Request $request
     * @param User $user
     * @param Message $message
     */
    public function __construct(Request $request, User $user, Message $message)
    {
        $this->request = $request;
        $this->user = $user;
        $this->message = $message;
    }

    /**
     * @return Channel|Channel[]|PrivateChannel
     */
    public function broadcastOn()
    {
        // We might broadcast on `user` or `channel`
        $channel = sprintf(
            '%s.%s',
            strtolower(class_basename($this->message->subjectable_type)),
            $this->message->subjectable->uuid
        );

        return new PrivateChannel($channel);
    }

    /**
     * @return string
     */
    public function broadcastAs() : string
    {
        return 'message.created';
    }

    /**
     * @return array
     */
    public function broadcastWith() : array
    {
        return (new MessageResource($this->message))->toArray($this->request);
    }
}
