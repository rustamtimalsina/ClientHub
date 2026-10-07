<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;

uses(RefreshDatabase::class);

test('client can access set-password page within 48 hours of invitation', function () {
    $token = Str::random(32);
    $user = User::factory()->create([
        'role' => 'client',
        'invitation_token' => $token,
        'invitation_sent_at' => now()->subHours(24), // 24 hours ago (valid)
    ]);

    $this->get(route('invitations.show', $token))
        ->assertOk();
});

test('client cannot access set-password page after 48 hours', function () {
    $token = Str::random(32);
    $user = User::factory()->create([
        'role' => 'client',
        'invitation_token' => $token,
        'invitation_sent_at' => now()->subHours(49), // 49 hours ago (expired)
    ]);

    $this->get(route('invitations.show', $token))
        ->assertStatus(410);
});

test('client cannot set password using an expired invitation token', function () {
    $token = Str::random(32);
    $user = User::factory()->create([
        'role' => 'client',
        'invitation_token' => $token,
        'invitation_sent_at' => now()->subHours(50),
    ]);

    $this->post(route('invitations.update', $token), [
        'password' => 'Password123!',
        'password_confirmation' => 'Password123!',
    ])->assertStatus(410);
});