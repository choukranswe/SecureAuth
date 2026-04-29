<?php

namespace Tests\Feature\Auth;

use App\Models\AuthOtp;
use App\Models\User;
use App\Notifications\LoginOtpNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class OtpVerificationTest extends TestCase
{
    use RefreshDatabase;

    public function test_private_pages_redirect_to_otp_until_session_is_verified(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertRedirect(route('otp.show', absolute: false));
    }

    public function test_dashboard_renders_after_otp_session_is_verified(): void
    {
        $user = User::factory()->create();

        $this->actingAsOtpVerified($user)
            ->get('/dashboard')
            ->assertOk()
            ->assertSee('Security command center');
    }

    public function test_valid_otp_marks_code_used_and_unlocks_session(): void
    {
        $user = User::factory()->create();

        AuthOtp::create([
            'user_id' => $user->id,
            'otp' => Hash::make('123456'),
            'expires_at' => now()->addMinutes(10),
            'used' => false,
        ]);

        $response = $this->actingAs($user)->post(route('otp.verify'), [
            'otp' => '123456',
        ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertSessionHas('otp_verified_for', $user->id)
            ->assertRedirect(route('dashboard', absolute: false));

        $this->assertDatabaseHas('auth_otps', [
            'user_id' => $user->id,
            'used' => true,
        ]);
    }

    public function test_expired_otp_is_rejected(): void
    {
        $user = User::factory()->create();

        AuthOtp::create([
            'user_id' => $user->id,
            'otp' => Hash::make('123456'),
            'expires_at' => now()->subMinute(),
            'used' => false,
        ]);

        $response = $this->actingAs($user)->post(route('otp.verify'), [
            'otp' => '123456',
        ]);

        $response->assertSessionHasErrors('otp');
    }

    public function test_resend_regenerates_code_and_marks_old_code_used(): void
    {
        Notification::fake();

        $user = User::factory()->create();

        $oldOtp = AuthOtp::create([
            'user_id' => $user->id,
            'otp' => Hash::make('123456'),
            'expires_at' => now()->addMinutes(10),
            'used' => false,
        ]);

        $response = $this->actingAs($user)->post(route('otp.resend'));

        $response->assertRedirect();
        $this->assertTrue($oldOtp->fresh()->used);
        $this->assertSame(1, AuthOtp::where('user_id', $user->id)->where('used', false)->count());
        Notification::assertSentTo($user, LoginOtpNotification::class);
    }
}
