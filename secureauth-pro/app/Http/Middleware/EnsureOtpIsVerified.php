<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureOtpIsVerified
{
    public function handle(Request $request, Closure $next): Response|RedirectResponse
    {
        $user = $request->user();

        if (! $user) {
            return $next($request);
        }

        if ($request->session()->get('otp_verified_for') === $user->id) {
            return $next($request);
        }

        // OTP middleware keeps authenticated sessions out of private pages until
        // the second email factor proves the current browser session is trusted.
        return redirect()->route('otp.show')
            ->with('status', __('Verify your one-time code to continue.'));
    }
}
