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
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignIdFor(Employee::class);
            $table->decimal('amount', 10, 2);
            $table->integer('installments');
            $table->decimal('emi_amount', 10, 2);
            $table->decimal('remaining_amount', 10, 2);
            $table->enum('status', ['active','completed'])->default('active');
            $table->date('start_month');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
