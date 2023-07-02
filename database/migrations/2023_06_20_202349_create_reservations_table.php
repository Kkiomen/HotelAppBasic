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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hotel_id');
            $table->text('name')->nullable();
            $table->dateTime('check_in')->nullable();
            $table->dateTime('check_out')->nullable();
            $table->text('description')->nullable();
            $table->float('total_basic_price')->nullable();
            $table->integer('number_adult')->nullable();
            $table->integer('number_child')->nullable();
            $table->text('room_preference')->nullable();
            $table->boolean('paid_reservation')->default(false);

            // Can use wallet. If no, user must all time pay for services
            $table->boolean('can_use_wallet')->default(false);
            $table->float('wallet_balance')->default(0);

            $table->boolean('can_pay_by_wallet')->default(false);


            // cost sharing. Does each person have their own wallet and pay for services or is there a shared
            $table->boolean('cost_breakdown')->default(false);

            // Can other guests buy through their service account, or can you only buy through the account of the main booker
            $table->boolean('purchase_by_other_guests')->default(false);

            // From what amount to give limit notification
            $table->float('wallet_limit')->default(0);

            // From what amount to block the purchase of further services
            $table->float('wallet_hard_limit')->default(0);

            $table->boolean('is_active')->default(false);

            $table->integer('status')->default(0);
            $table->text('name_reservation_person')->nullable();
            $table->string('nip')->nullable();
            $table->string('regon')->nullable();
            $table->string('krs')->nullable();
            $table->string('address')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->text('phone')->nullable();
            $table->text('email')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('hotel_id')->references('id')->on('hotels')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
