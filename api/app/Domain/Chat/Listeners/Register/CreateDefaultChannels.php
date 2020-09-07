<?php

namespace App\Domain\Chat\Listeners\Register;

use App\Domain\Chat\Models\Channel;
use App\Domain\Infrastructure\Events\Auth\RegisterEvent;

class CreateDefaultChannels
{
    /**
     * @param RegisterEvent $event
     * @return void
     */
    public function handle(RegisterEvent $event) : void
    {
        // If there's no channels, create default
        $channels = Channel::count();

        if ($channels > 0) {
            return;
        }

        Channel::create([
            'name' => 'General',
            'description' => 'General team discussion!',
        ]);
    }
}
