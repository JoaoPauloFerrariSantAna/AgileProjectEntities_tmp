<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sale_tbl', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('product_id');
            $table->integer("amount_sold");
            $table->timestamps();
            $table->foreign("user_id")->references("id")->on("user_tbl");
            $table->foreign("product_id")->references("id")->on("product_tbl");
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sale_tbl');
    }
};