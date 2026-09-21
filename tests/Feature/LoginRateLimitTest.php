<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\RateLimiter;

uses(RefreshDatabase::class);

test('login locks out after too many failed attempts', function () {
    User::factory()->create([
        'email' => 'test@example.com',
        'password' => bcrypt('correct-password'),
        'role' => 'client',
    ]);

    // Fail 5 times
    for ($i = 0; $i < 5; $i++) {
        $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'wrong-password',
        ]);
    }

    // 6th attempt should be blocked, even with the correct password
    $response = $this->post('/login', [
        'email' => 'test@example.com',
        'password' => 'correct-password',
    ]);

    $response->assertSessionHasErrors();
    $this->assertGuest();
});