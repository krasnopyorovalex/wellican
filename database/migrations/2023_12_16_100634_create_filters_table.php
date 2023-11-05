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
        Schema::create('filters', static function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->unsignedTinyInteger('parent_id');
            $table->string('name', 128);

            $table->foreign('parent_id')
                ->references('id')
                ->on('object_types')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('filters');
    }
};
