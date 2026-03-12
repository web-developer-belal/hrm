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
        Schema::table('ot_payments', function (Blueprint $table) {
            $table->unsignedSmallInteger('year')->after('employee_id');
            $table->unsignedTinyInteger('month')->after('year');
            $table->unsignedInteger('overtime_minutes')->default(0)->after('month');
            $table->boolean('is_paid')->default(false)->after('overtime_minutes');

            // Prevent double payment for same employee + month + year
            $table->unique(['employee_id', 'year', 'month'], 'ot_payments_employee_year_month_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ot_payments', function (Blueprint $table) {
             $table->dropUnique('ot_payments_employee_year_month_unique');
            $table->dropColumn(['year', 'month', 'overtime_minutes', 'is_paid']);
        });
    }
};
