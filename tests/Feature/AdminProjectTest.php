<?php

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('an admin can create a project', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $client = User::factory()->create(['role' => 'client']);

    $response = $this->actingAs($admin)->post('/admin/projects', [
        'client_id' => $client->id,
        'name' => 'Test Project',
        'description' => 'A project created in a test.',
        'status' => 'pending',
        'start_date' => '2026-01-01',
        'due_date' => '2026-02-01',
    ]);

    $response->assertRedirect();
    $this->assertDatabaseHas('projects', [
        'name' => 'Test Project',
        'client_id' => $client->id,
    ]);
});

test('a client cannot create a project', function () {
    $client = User::factory()->create(['role' => 'client']);
    $otherClient = User::factory()->create(['role' => 'client']);

    $response = $this->actingAs($client)->post('/admin/projects', [
        'client_id' => $otherClient->id,
        'name' => 'Sneaky Project',
        'status' => 'pending',
    ]);

    $response->assertStatus(403);
    $this->assertDatabaseMissing('projects', ['name' => 'Sneaky Project']);
});

test('an admin can delete a project', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $project = Project::factory()->create();

    $response = $this->actingAs($admin)->delete("/admin/projects/{$project->id}");

    $response->assertRedirect();
    $this->assertDatabaseMissing('projects', ['id' => $project->id]);
});