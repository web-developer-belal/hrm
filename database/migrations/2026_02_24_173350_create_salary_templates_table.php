<?php

use App\Models\Designation;
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
        Schema::create('salary_templates', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Designation::class);
            $table->decimal('basic_salary', 15, 2);
            $table->decimal('house_rent', 15, 2);
            $table->decimal('medical_allowance', 15, 2);
            $table->decimal('dear_allowance', 15, 2);
            $table->decimal('transport_allowance', 15, 2);
            $table->decimal('pf_employer_contribution', 15, 2)->default(0);
            $table->decimal('other_allowance', 15, 2)->default(0);

            $table->decimal('pf_employee_contribution', 15, 2)->default(0);
            $table->decimal('welfare_contribution', 15, 2)->default(0);
            $table->decimal('tax_deduction', 15, 2)->default(0);


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salary_templates');
    }
};
