<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function actingAsOtpVerified(User $user): static
    {
        $this->actingAs($user);

        return $this->withSession([
            'otp_verified_for' => $user->id,
            'otp_verified_at' => now()->toIso8601String(),
        ]);
    }
}
