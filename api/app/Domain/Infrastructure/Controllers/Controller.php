<?php

namespace App\Domain\Infrastructure\Controllers;

use Throwable;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use DispatchesJobs;
    use ValidatesRequests;
    use AuthorizesRequests;

    /**
     * @param bool $assertion
     * @param Throwable|null $throwable
     * @throws Throwable
     * @return void
     */
    public function assert(bool $assertion, ?Throwable $throwable) : void
    {
        if ($assertion) {
            throw $throwable;
        }
    }
}
