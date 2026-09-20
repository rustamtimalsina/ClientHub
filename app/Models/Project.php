<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'client_id',
        'name',
        'description',
        'status',
        'start_date',
        'due_date',
        'created_at',
        'updated_at',
    ];
    protected $casts = [
        'start_date' => 'date',
        'due_date' => 'date',
    ];
    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }
    public function milestones()
{
    return $this->hasMany(Milestone::class);
}
    public function files()
    {
        return $this->hasMany(ProjectFile::class);
    }
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
