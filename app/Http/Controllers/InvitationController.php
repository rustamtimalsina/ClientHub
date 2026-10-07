<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class InvitationController extends Controller
{
    public function show(string $token)
    {
        $user = User::where('invitation_token', $token)->firstOrFail();

        abort_if(
            !$user->invitation_sent_at || Carbon::parse($user->invitation_sent_at)->addHours(48)->isPast(),
            410,
            'This invitation link has expired. Please contact the administrator for a new one.'
        );

        return view('auth.set-password', compact('user', 'token'));
    }

    public function update(Request $request, string $token)
    {
        $user = User::where('invitation_token', $token)->firstOrFail();

        abort_if(
            !$user->invitation_sent_at || Carbon::parse($user->invitation_sent_at)->addHours(48)->isPast(),
            410,
            'This invitation link has expired. Please contact the administrator for a new one.'
        );

        $request->validate([
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user->update([
            'password' => Hash::make($request->password),
            'invitation_token' => null,
            'email_verified_at' => now(),
        ]);

        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Your password has been set. Welcome aboard!');
    }
}