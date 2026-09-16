<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->foreignId('client_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->string('status')->default('active');
            $table->date('start_date')->nullable();
            $table->date('due_date')->nullable();
        });

        Schema::table('milestones', function (Blueprint $table) {
            $table->foreignId('project_id')->nullable()->constrained('projects')->cascadeOnDelete();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('status')->default('pending');
            $table->dateTime('completed_at')->nullable();
        });

        Schema::table('project_files', function (Blueprint $table) {
            $table->foreignId('project_id')->nullable()->constrained('projects')->cascadeOnDelete();
            $table->foreignId('uploaded_by')->nullable()->constrained('users')->nullOnDelete();
            $table->string('original_name')->nullable();
            $table->string('file_path')->nullable();
            $table->string('mime_type')->nullable();
            $table->unsignedBigInteger('file_size')->nullable();
        });

        Schema::table('invoices', function (Blueprint $table) {
            $table->foreignId('project_id')->nullable()->constrained('projects')->cascadeOnDelete();
            $table->string('invoice_number')->nullable();
            $table->string('status')->default('pending');
            $table->decimal('amount', 10, 2)->default(0);
            $table->date('issued_at')->nullable();
            $table->date('due_date')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropForeign(['project_id']);
            $table->dropColumn([
                'project_id',
                'invoice_number',
                'status',
                'amount',
                'issued_at',
                'due_date',
            ]);
        });

        Schema::table('project_files', function (Blueprint $table) {
            $table->dropForeign(['project_id']);
            $table->dropForeign(['uploaded_by']);
            $table->dropColumn([
                'project_id',
                'uploaded_by',
                'original_name',
                'file_path',
                'mime_type',
                'file_size',
            ]);
        });

        Schema::table('milestones', function (Blueprint $table) {
            $table->dropForeign(['project_id']);
            $table->dropColumn([
                'project_id',
                'title',
                'description',
                'status',
                'completed_at',
            ]);
        });

        Schema::table('projects', function (Blueprint $table) {
            $table->dropForeign(['client_id']);
            $table->dropColumn([
                'client_id',
                'name',
                'description',
                'status',
                'start_date',
                'due_date',
            ]);
        });
    }
};