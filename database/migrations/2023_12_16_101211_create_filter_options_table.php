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
        Schema::create('filter_options', static function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->unsignedTinyInteger('filter_id');
            $table->string('value', 128);

            $table->foreign('filter_id')
                ->references('id')
                ->on('filters')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('filter_options');
    }
};
