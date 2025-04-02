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
        Schema::create('warehouse_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("item_id");
            $table->unsignedBigInteger("branch_id");
            $table->string("tags");
            $table->string("actions");
            $table->mediumText("notes");
            $table->integer("quantity");
            $table->timestamps();
            $table->foreign("item_id")->references("id")->on("warehouse_modules");
            $table->foreign("branch_id")->references("id")->on("warehouse_branches");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warehouse_logs');
        
    }
};
