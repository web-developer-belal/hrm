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
        Schema::create('complains', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id');
            $table->foreignId('employee_id');
            $table->foreignId('against_employee_id');
            $table->string('subject');
            $table->date('date');
            $table->string('document')->nullable();
            $table->text('description')->nullable();
            $table->tinyInteger('status')->default(0)->comment('0: pending, 1: resolved, 2: rejected');
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complains');
    }
};
