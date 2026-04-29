<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(Request $request): View
    {
        $user = $request->user();

        return view('dashboard', [
            'notesCount' => $user->secureNotes()->count(),
            'recentNotes' => $user->secureNotes()
                ->latest()
                ->take(4)
                ->get(),
            'otpVerified' => $request->session()->get('otp_verified_for') === $user->id,
        ]);
    }
}
