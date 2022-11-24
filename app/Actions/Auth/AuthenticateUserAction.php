<?php

namespace App\Actions\Auth;

use App\Http\Requests\Auth\AuthenticateUserRequest;
use Illuminate\Http\JsonResponse;
use Lorisleiva\Actions\Concerns\AsAction;

class AuthenticateUserAction
{
    use AsAction;

    public function handle(AuthenticateUserRequest $request): JsonResponse
    {
        return $request->authenticate();
    }
}
