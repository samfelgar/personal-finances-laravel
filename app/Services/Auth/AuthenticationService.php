<?php

namespace App\Services\Auth;

use App\Models\User;
use DomainException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthenticationService
{
    public function login(string $email, string $password): string
    {
        $user = $this->userByEmail($email);

        if ($user === null) {
            throw new DomainException('Invalid e-mail or password');
        }

        if (!$this->validatePassword($password, $user->password)) {
            throw new DomainException('Invalid e-mail or password');
        }

        return $user->createToken(Str::random(), expiresAt: now()->addDay())->plainTextToken;
    }

    /**
     * @return Model<User>|null
     */
    private function userByEmail(string $email): ?User
    {
        return User::query()
            ->where('email', $email)
            ->first();
    }

    private function validatePassword(string $plain, string $hashed): bool
    {
        return Hash::check($plain, $hashed);
    }

    public function revokeCurrentAccessToken(User $user): void
    {
        $accessToken = $user->currentAccessToken();

        if ($accessToken instanceof Model) {
            $accessToken->delete();
        }
    }

    public function revokeAllAccessTokens(User $user): void
    {
        $user->tokens()->delete();
    }
}
