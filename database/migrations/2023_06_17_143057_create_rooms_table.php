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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('hotel_id')->unsigned();
            $table->string('name');
            $table->integer('number_place')->nullable();
            $table->integer('max_person')->nullable();
            $table->integer('number_bed')->nullable();
            $table->boolean('is_active')->default(false);
            $table->enum('accomodation_type', \App\Enums\AccomodationType::toArray())->default(\App\Enums\AccomodationType::ROOM->value);
            $table->enum('accomodation_type_price', \App\Enums\RoomTypePrice::toArray())->default(\App\Enums\RoomTypePrice::PER_PERSON->value);
            $table->text('description')->nullable();
            $table->date('available_date_from')->nullable();
            $table->date('available_date_to')->nullable();
            $table->foreign('hotel_id')->references('id')->on('hotels')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
