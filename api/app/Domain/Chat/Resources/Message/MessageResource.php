<?php

namespace App\Domain\Chat\Resources\Message;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Domain\Chat\Resources\Channel\BaseChannelResource;
use App\Domain\Infrastructure\Resources\User\CreatorResource;

class MessageResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request) : array
    {
        return [
            'uuid' => $this->uuid,

            'message' => $this->message,
            'channel' => new BaseChannelResource($this->channel),

            'user' => new CreatorResource($this->user),

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
