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
        Schema::create('objects', static function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('type_id');
            $table->unsignedSmallInteger('location_id');
            $table->string('alias')->unique();
            $table->string('name');
            $table->unsignedInteger('price'); //max => 4_294_967_295, занимает 4 байта
            $table->enum('type_purchase', ['Buy', 'Rent']);
            $table->unsignedMediumInteger('square')->default(0);
            $table->decimal('latitude', 9, 6);
            $table->decimal('longitude', 9, 6);
            $table->text('description');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('type_id')
                ->references('id')
                ->on('object_types')
                ->restrictOnDelete();

            $table->foreign('location_id')
                ->references('id')
                ->on('locations')
                ->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('objects');
    }
};
