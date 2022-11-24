<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Auth\AuthenticateUserAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthenticateUserRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthenticateUserController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(AuthenticateUserRequest $request): JsonResponse
    {
        return AuthenticateUserAction::run($request);
    }
}
