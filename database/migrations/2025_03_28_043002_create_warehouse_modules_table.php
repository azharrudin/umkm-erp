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
        Schema::create('warehouse_modules', function (Blueprint $table) {
            $table->id();
            $table->string("item_code")->index();
            $table->string("item_stocking_unit");
            $table->integer("item_price");
            $table->date("item_since");
            $table->string("item_name");
            $table->mediumText("notes");
            $table->unsignedBigInteger("supplier_id");
            $table->foreign("supplier_id")->references("id")->on("warehouse_suppliers");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warehouse_modules');
    }
};
