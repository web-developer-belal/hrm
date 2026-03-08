<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();

            // who did it
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();

            // what happened
            $table->string('event', 30); // created|updated|deleted|login|logout|failed_login
            $table->string('subject_type')->nullable(); // App\Models\Employee etc.
            $table->unsignedBigInteger('subject_id')->nullable();

            // change details
            $table->json('old_values')->nullable();
            $table->json('new_values')->nullable();
            $table->text('description')->nullable();

            // request metadata
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->text('url')->nullable();
            $table->string('method', 10)->nullable();
            $table->string('route_name')->nullable();

            $table->timestamp('created_at')->useCurrent();

            $table->index(['user_id', 'created_at']);
            $table->index(['event', 'created_at']);
            $table->index(['subject_type', 'subject_id']);
            $table->index('route_name');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};