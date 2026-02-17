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
        Schema::create('payrolls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id');
            $table->foreignId('employee_id');
            $table->integer('year');
            $table->integer('month');
            $table->integer('total_days');
            $table->integer('total_working_days');
            $table->integer('present_days')->nullable();
            $table->integer('off_days')->nullable();
            $table->integer('holy_days')->nullable();
            $table->integer('absent_days')->nullable();
            $table->integer('late_days')->nullable();
            $table->integer('late_penalty_days')->nullable();
            $table->decimal('per_day_salary',10,2);
            $table->decimal('basic_salary', 12,2)->default(0);
            $table->decimal('attendance_bonus', 12,2)->default(0)->nullable();
            $table->decimal('total_ot', 12,2)->default(0)->nullable();
            $table->decimal('late_deduction', 12,2)->default(0)->nullable();
            $table->decimal('loan_deduction', 12,2)->default(0)->nullable();
            $table->decimal('positive_adjustments', 12,2)->default(0);
            $table->decimal('negative_adjustments', 12,2)->default(0);
            $table->decimal('absent_deduction',10,2)->default(0)->nullable();
            $table->decimal('total_deduction',10,2);
            $table->decimal('gross_salary', 12,2)->default(0);
            $table->decimal('net_salary', 12,2)->default(0);
            $table->boolean('is_locked')->default(false);
            $table->string('status')->default('draft');
            $table->foreignId('approved_by')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->boolean('is_generated')->default(false);
            $table->string('approval_stage')->default('branch_hr')->comment('branch_hr, branch_manager, finance, completed');
            $table->unique(['employee_id','year','month']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payrolls');
    }
};
