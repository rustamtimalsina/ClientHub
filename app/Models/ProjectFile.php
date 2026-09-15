<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectFile extends Model
{
    protected $fillable = [
        'id',
        'project_id',
        'uploaded_by',
        'original_name',
        'file_path',
        'mime_type',
        'file_size',
        'created_at',
        'updated_at',
    ];
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
 
    public function uploadedBy()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}
