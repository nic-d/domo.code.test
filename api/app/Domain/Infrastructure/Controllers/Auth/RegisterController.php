<?php

namespace App\Domain\Infrastructure\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use App\Domain\Infrastructure\Models\User;
use Illuminate\Validation\ValidationException;
use App\Domain\Infrastructure\Controllers\Controller;
use App\Domain\Infrastructure\Events\Auth\RegisterEvent;
use App\Domain\Infrastructure\Resources\User\UserResource;

class RegisterController extends Controller
{
    /**
     * @param Request $request
     * @return UserResource|JsonResponse
     * @throws ValidationException
     */
    public function __invoke(Request $request)
    {
        $this->validate($request, [
            'name'             => ['required', 'string', 'min:3', 'max:20'],
            'email'            => ['sometimes', 'nullable', 'email', 'unique:users,email'],
            'password'         => ['required', 'string', 'min:6', 'max:100'],
            'confirm_password' => ['required', 'string', 'same:password'],
        ]);

        /** @var User $user */
        $user = User::create([
            'name'      => $request->input('name'),
            'email'     => $request->input('email'),
            'password'  => Hash::make($request->input('password')),
        ]);

        event(new RegisterEvent($request, $user));

        return new UserResource($user);
    }
}
