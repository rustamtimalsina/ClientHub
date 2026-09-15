<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'id',
        'project_id',
        'invoice_number',
        'status',
        'amount',
        'issued_at',
        'due_date',
        'created_at',
        'updated_at',
    ];
    protected $casts = [
        'amount' => 'decimal:2',
        'issued_at' => 'date',
        'due_date' => 'date',
    ];
}
