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
        Schema::create('resignations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained()->cascadeOnDelete();
            $table->string('subject');
            $table->date('resignation_date');
            $table->longText('reason')->nullable();
            $table->text('comment')->nullable();
            $table->unsignedBigInteger('approver_by')->nullable();
            $table->foreign('approver_by')->references('id')->on('users')->nullOnDelete();
            $table->enum('status',['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resignations');
    }
};
