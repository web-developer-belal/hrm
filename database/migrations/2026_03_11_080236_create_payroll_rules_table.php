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
        Schema::create('payroll_rules', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // "Festival Bonus", "Attendance Bonus"
            $table->enum('type', ['bonus', 'deduction'])->default('bonus');
            $table->enum('calc_type', ['fixed', 'percentage', 'per_day'])->default('fixed');
            // fixed   → flat amount e.g. 5000
            // percentage → % of basic salary  e.g. 10%
            // per_day → amount × working days e.g. 50 × 22
            $table->decimal('value', 12, 2);

            // Optional: only apply when condition is met
            $table->enum('condition_type', ['always', 'min_present_days', 'date_range'])->default('always');
            $table->integer('condition_present_days')->nullable(); // for min_present_days
            $table->date('condition_from')->nullable();            // for date_range (festival)
            $table->date('condition_to')->nullable();

            // Scope: where does this rule apply?
            $table->foreignId('branch_group_id')->nullable()->constrained('branch_groups')->nullOnDelete();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payroll_rules');
    }
};
