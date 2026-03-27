<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_tbl', function (Blueprint $table) {
            $table->id();
            $table->string("name", 32);
            $table->string("password", 16);
            $table->string("email", 32);
            $table->enum("role", array("adm", "gerente", "analista"));
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_tbl');
    }
};