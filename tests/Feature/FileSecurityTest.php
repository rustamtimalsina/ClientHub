<?php

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->client = User::factory()->create([
        'role' => 'client',
    ]);

    $this->project = Project::factory()->create([
        'client_id' => $this->client->id,
    ]);
});

test('guests are redirected to login when accessing admin file routes', function () {
    $this->get(route('admin.files.create', $this->project))
        ->assertRedirect(route('login'));

    $this->post(route('admin.files.store', $this->project), [])
        ->assertRedirect(route('login'));
});

test('clients are forbidden from accessing admin file routes', function () {
    $this->actingAs($this->client)
        ->get(route('admin.files.create', $this->project))
        ->assertForbidden();

    $this->actingAs($this->client)
        ->post(route('admin.files.store', $this->project), [])
        ->assertForbidden();
});

test('admins can access file routes', function () {
    $admin = User::factory()->create([
        'role' => 'admin',
    ]);

    $this->actingAs($admin)
        ->get(route('admin.files.create', $this->project))
        ->assertOk();
});