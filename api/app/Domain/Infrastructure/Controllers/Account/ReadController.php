<?php

namespace App\Domain\Infrastructure\Controllers\Account;

use Illuminate\Http\Request;
use App\Domain\Infrastructure\Controllers\Controller;
use App\Domain\Infrastructure\Resources\User\UserResource;

class ReadController extends Controller
{
    /**
     * @param Request $request
     * @return UserResource
     */
    public function __invoke(Request $request) : UserResource
    {
        return new UserResource($request->user());
    }
}
