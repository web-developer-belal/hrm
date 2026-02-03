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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('employee_id')->constrained()->cascadeOnDelete();
            $table->foreignId('roster_id')->constrained()->cascadeOnDelete();
            $table->date('date');
            $table->time('shift_start_time');
            $table->time('shift_end_time');
            $table->timestamp('clock_in')->nullable();
            $table->timestamp('clock_out')->nullable();
            $table->integer('late_minutes')->default(0);
            $table->integer('early_exit_minutes')->default(0);
            $table->enum('status',['present','absent','leave','holiday'])->default('absent');
            $table->timestamps();
            $table->unique(['employee_id','date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
