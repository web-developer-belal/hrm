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
        Schema::create('attendance_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('device_id')->nullable();
            $table->unsignedBigInteger('employee_id');
            $table->date('attendance_date');
            $table->time('attendance_time');
            $table->string('attendance_minute');
            $table->timestamp('device_timestamp');
            $table->timestamps();

    $table->unique(['employee_id','attendance_minute']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendance_logs');
    }
};
