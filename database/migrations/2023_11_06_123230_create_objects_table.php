<?php

use Domain\Entities\Object\Enums\IsPremium;
use Domain\Entities\Object\Enums\TypePurchase;
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
        Schema::create('objects', static function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('type_id');
            $table->unsignedSmallInteger('location_id');
            $table->unsignedSmallInteger('label_id');
            $table->string('alias')->unique();
            $table->string('articul', 32)->unique();
            $table->string('name');
            $table->unsignedInteger('price'); //max => 4_294_967_295, занимает 4 байта
            $table->enum('type_purchase', array_column(TypePurchase::cases(), 'value'));
            $table->decimal('square', 9, 1, true);
            $table->decimal('latitude', 9, 6);
            $table->decimal('longitude', 9, 6);
            $table->string('address');
            $table->text('description');
            $table->enum('is_premium', array_column(IsPremium::cases(), 'value'))->default('not');
            $table->timestamps();

            $table->foreign('type_id')
                ->references('id')
                ->on('object_types')
                ->restrictOnDelete();

            $table->foreign('location_id')
                ->references('id')
                ->on('locations')
                ->restrictOnDelete();

            $table->foreign('label_id')
                ->references('id')
                ->on('object_labels')
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
