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
        Schema::create('images', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->unsignedSmallInteger('imageable_id'); //max => 65535, занимает 2 байтa
            $table->string('imageable_type');
            $table->char('filename', 40);
            $table->string('ext', 4);
            $table->string('title')->default('');
            $table->string('alt')->default('');

            $table->index(['imageable_id', 'imageable_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};
