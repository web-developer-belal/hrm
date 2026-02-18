<?php

use App\Models\Employee;
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
        Schema::create('payroll_adjustments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignIdFor(Employee::class);
            $table->enum('type', ['advance', 'addition', 'deduction']);
            $table->decimal('amount', 10, 2);
            $table->string('note')->nullable();
            $table->boolean('is_settled')->default(false);
            $table->integer('year')->nullable();
            $table->integer('month')->nullable();
            $table->date('date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payroll_adjustments');
    }
};
