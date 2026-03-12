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
        Schema::create('ot_rates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ot_id');
            $table->unsignedBigInteger('designation_id');
            $table->decimal('rate', 8, 2);
            $table->foreign('ot_id')->references('id')->on('ots')->onDelete('cascade');
            $table->foreign('designation_id')->references('id')->on('designations')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ot_rates');
    }
};
