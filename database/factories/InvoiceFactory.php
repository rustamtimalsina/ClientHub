<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceFactory extends Factory
{
    public function definition(): array
    {
        return [
            'project_id' => Project::factory(),
            'invoice_number' => 'INV-' . fake()->unique()->numberBetween(1000, 9999),
            'status' => 'pending',
            'amount' => fake()->randomFloat(2, 1000, 50000),
            'issued_at' => now(),
            'due_date' => now()->addMonth(),
        ];
    }
}