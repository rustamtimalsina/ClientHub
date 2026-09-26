<?php

use App\Models\Milestone;
use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('a client can comment on their own milestone', function () {
    $client = User::factory()->create(['role' => 'client']);
    $project = Project::factory()->create(['client_id' => $client->id]);
    $milestone = Milestone::factory()->create(['project_id' => $project->id]);

    $response = $this->actingAs($client)
        ->post("/milestones/{$milestone->id}/comments", ['body' => 'Looks great!']);

    $response->assertRedirect();
    $this->assertDatabaseHas('comments', [
        'milestone_id' => $milestone->id,
        'user_id' => $client->id,
        'body' => 'Looks great!',
    ]);
});

test('an admin can comment on any milestone', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $milestone = Milestone::factory()->create();

    $response = $this->actingAs($admin)
        ->post("/milestones/{$milestone->id}/comments", ['body' => 'Thanks for the update!']);

    $response->assertRedirect();
    $this->assertDatabaseHas('comments', ['user_id' => $admin->id]);
});

test('a client cannot comment on someone elses milestone', function () {
    $client = User::factory()->create(['role' => 'client']);
    $otherClient = User::factory()->create(['role' => 'client']);
    $project = Project::factory()->create(['client_id' => $otherClient->id]);
    $milestone = Milestone::factory()->create(['project_id' => $project->id]);

    $response = $this->actingAs($client)
        ->post("/milestones/{$milestone->id}/comments", ['body' => 'Sneaky comment']);

    $response->assertStatus(403);
    $this->assertDatabaseMissing('comments', ['body' => 'Sneaky comment']);
});