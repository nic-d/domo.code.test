<?php

namespace App\Domain\Infrastructure\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Bus\Dispatchable;

class Event
{
    use Dispatchable;
    use SerializesModels;
}
