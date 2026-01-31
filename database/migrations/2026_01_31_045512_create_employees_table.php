<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('photo')->nullable();
            $table->string('employee_name');
            $table->date('date_of_birth')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->string('contact_number', 20);
            $table->string('alternative_phone_number', 20)->nullable();
            $table->text('local_address')->nullable();
            $table->text('permanent_address')->nullable();
            $table->text('description')->nullable();
            $table->string('employee_code')->unique();
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('department_id')->nullable()->constrained('departments')->nullOnDelete();
            $table->foreignId('designation_id')->nullable()->constrained('designations')->nullOnDelete();
            $table->foreignId('shift_id')->nullable()->constrained('shifts')->nullOnDelete();
            $table->date('joining_date');
            $table->string('workspace')->nullable();
            $table->foreignId('supervisor_id')
                  ->nullable()
                  ->constrained('employees')
                  ->nullOnDelete();
            $table->string('bank_name')->nullable();
            $table->string('routing_number')->nullable();
            $table->string('account_holder_name')->nullable();
            $table->enum('bank_account_type', ['savings', 'current', 'other'])->nullable();
            $table->string('account_number')->nullable();
            $table->text('bank_notes')->nullable();
            $table->timestamps();
            $table->index('branch_id');
            $table->index('department_id');
            $table->index('designation_id');
            $table->index('shift_id');
            $table->index('supervisor_id');
            $table->index('employee_name');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
