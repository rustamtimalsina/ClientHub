<?php

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->admin = User::factory()->create([
        'role' => 'admin',
    ]);
});

test('admin projects index paginates and page 2 is accessible', function () {
    $client = User::factory()->create(['role' => 'client']);

    Project::factory()->count(15)->create([
        'client_id' => $client->id,
    ]);

    $response = $this->actingAs($this->admin)
        ->get(route('admin.projects.index', ['page' => 2]));

    $response->assertOk();
    $response->assertViewHas('projects', function ($projects) {
        return $projects->currentPage() === 2 && $projects->count() === 5;
    });
});

test('admin clients page paginates and page 2 is accessible', function () {
    User::factory()->count(15)->create([
        'role' => 'client',
    ]);

    $response = $this->actingAs($this->admin)
        ->get(route('admin.clients.create', ['page' => 2]));

    $response->assertOk();
    $response->assertViewHas('clients', function ($clients) {
        return $clients->currentPage() === 2;
    });
});