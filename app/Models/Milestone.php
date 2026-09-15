<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Milestone extends Model
{
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
    public function milestones()
    {
        return $this->hasMany(Milestone::class);
    }
}
