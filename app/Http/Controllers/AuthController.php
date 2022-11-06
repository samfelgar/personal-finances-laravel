<?php

namespace App\Http\Controllers;

use App\Services\Auth\AuthenticationService;
use DomainException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class AuthController extends Controller
{
    public function __construct(
        protected readonly AuthenticationService $authenticationService
    ) {
    }

    public function login(Request $request): JsonResponse
    {
        ['email' => $email, 'password' => $password] = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        try {
            $token = $this->authenticationService->login($email, $password);

            return response()->json([
                'access_token' => $token,
            ]);
        } catch (DomainException $exception) {
            throw new BadRequestHttpException($exception->getMessage());
        }
    }

    public function logout(Request $request): Response
    {
        $this->authenticationService->revokeCurrentAccessToken($request->user());
        return response()->noContent();
    }

    public function logoutFromAllSessions(Request $request): Response
    {
        $this->authenticationService->revokeAllAccessTokens($request->user());
        return response()->noContent();
    }
}
