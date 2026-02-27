<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('device_sync_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('device_id');
            $table->integer('total_logs')->default(0);
            $table->timestamp('sync_started_at');
            $table->timestamp('sync_completed_at')->nullable();
            $table->string('status')->default('processing'); // success/failed
            $table->text('message')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('device_sync_histories');
    }
};
