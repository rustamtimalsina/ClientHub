<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('an admin visiting the client dashboard is redirected to the admin overview', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $response = $this->actingAs($admin)->get('/dashboard');

    $response->assertRedirect('/admin');
});

test('a client visiting the dashboard sees their own page, not a redirect', function () {
    $client = User::factory()->create(['role' => 'client']);

    $response = $this->actingAs($client)->get('/dashboard');

    $response->assertOk();
});