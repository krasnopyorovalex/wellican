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
        Schema::create('object_filters', static function (Blueprint $table) {
            //$table->unsignedTinyInteger('filter_id');
            $table->unsignedSmallInteger('filter_option_id');
            $table->unsignedBigInteger('object_id');

            $table->primary([/*'filter_id', */ 'filter_option_id', 'object_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('object_filters');
    }
};
