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
        Schema::create('sales_modules', function (Blueprint $table) {
            $table->id();
            $table->string("item_code");
            $table->integer("discount");
            $table->integer("tax");
            $table->integer("totalcount");
            $table->integer("totalprice");
            $table->date("selldate");
            $table->string("invoice");
            $table->foreign('item_code')->references('item_code')->on('warehouse_modules')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_modules');
    }
};
