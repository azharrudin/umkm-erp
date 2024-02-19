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
        Schema::create('employee_modules', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("email");
            $table->string("position");
            $table->string("address");
            $table->date("date_joined");
            $table->boolean("active");
            $table->date("date_exited")->nullable();
            $table->integer("salary");
            $table->string("salary_period");
            $table->string("salary_method");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_modules');
    }
};
