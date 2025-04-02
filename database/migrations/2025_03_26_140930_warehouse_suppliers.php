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
        Schema::create('warehouse_suppliers', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("contact");
            $table->string("sector");
            $table->mediumText("address");
            $table->mediumText("notes");
            $table->boolean("active");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warehouse_suppliers');
    }
};
