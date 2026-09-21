<?php

use App\Models\Project;
use App\Models\ProjectFile;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

uses(RefreshDatabase::class);

test('deleting a project also deletes its uploaded files from storage', function () {
    Storage::fake('public');

    $admin = User::factory()->create(['role' => 'admin']);
    $client = User::factory()->create(['role' => 'client']);
    $project = Project::factory()->create(['client_id' => $client->id]);

    $uploaded = UploadedFile::fake()->create('test-file.pdf', 100);
    $path = $uploaded->store('files', 'public');

    $file = ProjectFile::create([
        'project_id' => $project->id,
        'uploaded_by' => $admin->id,
        'original_name' => 'test-file.pdf',
        'file_path' => $path,
        'mime_type' => 'application/pdf',
        'file_size' => 100,
    ]);

    Storage::disk('public')->assertExists($path);

    $project->delete();

    Storage::disk('public')->assertMissing($path);
});