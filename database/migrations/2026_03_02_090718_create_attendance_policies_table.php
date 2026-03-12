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
        Schema::create('attendance_policies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();
            $table->string('policy_name');
            $table->string('description')->nullable();
            $table->integer('in_grace_period_minutes')->default(0);
            $table->integer('out_grace_period_minutes')->default(0);
            $table->integer('late_deduction_count_days')->default(0);
            $table->time('late_cutoff_time')->default('10:00:00');
            $table->boolean('mark_absent_if_late')->default(true);
            $table->unsignedInteger('late_penalty_threshold_days')->default(3);
            $table->decimal('late_penalty_deduct_days', 5, 2)->default(1);
            $table->unsignedTinyInteger('continuous_absent_months_for_suspend')->default(3);
            $table->boolean('auto_suspend_on_continuous_absence')->default(true);
            $table->enum('status', ['active', 'inactive'])->default('active');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendance_policies');
    }
};
