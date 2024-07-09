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
        Schema::create('object_images', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('object_id');
            $table->string('alt')->default('');
            $table->string('title')->default('');
            $table->char('filename', 40);
            $table->string('ext', 4);
            //            $table->string('url')->virtualAs('concat(directory, basename, \'.\', ext)');
            $table->unsignedTinyInteger('position')->default(0);
            $table->timestamps();

            $table->foreign('object_id')
                ->references('id')
                ->on('objects')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('object_images');
    }
};
