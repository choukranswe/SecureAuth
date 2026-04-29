<?php

namespace App\Services;

use App\Models\AuthOtp;
use App\Models\User;
use App\Notifications\LoginOtpNotification;
use Illuminate\Support\Facades\Hash;

class OtpService
{
    public const EXPIRATION_MINUTES = 10;

    public function issueFor(User $user): void
    {
        $plainOtp = (string) random_int(100000, 999999);

        AuthOtp::where('user_id', $user->id)
            ->where('used', false)
            ->update(['used' => true]);

        AuthOtp::create([
            'user_id' => $user->id,
            'otp' => Hash::make($plainOtp),
            'expires_at' => now()->addMinutes(self::EXPIRATION_MINUTES),
            'used' => false,
        ]);

        $user->notify(new LoginOtpNotification($plainOtp, self::EXPIRATION_MINUTES));
    }

    public function latestPendingFor(User $user): ?AuthOtp
    {
        return AuthOtp::where('user_id', $user->id)
            ->where('used', false)
            ->latest()
            ->first();
    }

    public function ensurePendingCode(User $user): void
    {
        $otp = $this->latestPendingFor($user);

        if (! $otp || $otp->isExpired()) {
            $this->issueFor($user);
        }
    }
}
