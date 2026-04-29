<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\OtpService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class OtpVerificationController extends Controller
{
    public function __construct(private readonly OtpService $otpService)
    {
    }

    public function show(Request $request): RedirectResponse|View
    {
        if ($request->session()->get('otp_verified_for') === $request->user()->id) {
            return redirect()->intended(route('dashboard', absolute: false));
        }

        $this->otpService->ensurePendingCode($request->user());

        return view('auth.otp-verify');
    }

    public function verify(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'otp' => ['required', 'digits:6'],
        ]);

        $otp = $this->otpService->latestPendingFor($request->user());

        if (! $otp) {
            throw ValidationException::withMessages([
                'otp' => __('Please request a new one-time code.'),
            ]);
        }

        if ($otp->isExpired()) {
            $otp->update(['used' => true]);

            throw ValidationException::withMessages([
                'otp' => __('This one-time code has expired. Please request a new code.'),
            ]);
        }

        if (! Hash::check($validated['otp'], $otp->otp)) {
            throw ValidationException::withMessages([
                'otp' => __('The one-time code is invalid.'),
            ]);
        }

        $otp->update(['used' => true]);

        $request->session()->put('otp_verified_for', $request->user()->id);
        $request->session()->put('otp_verified_at', now()->toIso8601String());

        return redirect()->intended(route('dashboard', absolute: false))
            ->with('success', __('OTP verified. Your secure session is active.'));
    }

    public function resend(Request $request): RedirectResponse
    {
        $this->otpService->issueFor($request->user());

        return back()->with('status', __('A fresh one-time code was sent to your email.'));
    }
}
