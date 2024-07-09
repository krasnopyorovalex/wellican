<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pages', static function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->string('template', 32)->default('index');
            $table->string('name');
            $table->string('title');
            $table->string('description')->default('');
            $table->string('keywords')->default('');
            $table->string('alias')->unique();
            $table->text('body');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
