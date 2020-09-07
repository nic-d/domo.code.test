<?php

namespace App\Domain\Chat\Resources\Channel;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BaseChannelResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request) : array
    {
        return [
            'uuid' => $this->uuid,
            'name' => $this->name,
            'description' => $this->description,
        ];
    }
}
