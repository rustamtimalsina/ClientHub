<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Milestone extends Model
{
    use HasFactory;
    protected $fillable = [
        'milestones',
        'id',
        'project_id',
        'title',
        'description',
        'status',
        'completed_at',
        'created_at'
    ];
    protected $casts = [
        'completed_at' => 'datetime',
    ];
    public function project()
{
    return $this->belongsTo(Project::class);
}
}
