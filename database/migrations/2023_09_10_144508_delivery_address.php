<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeliveryAddress extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id')->nullable();
            $table->string('recipient_name', 255)->nullable();
            $table->string('recipient_phone', 255)->nullable();
            $table->string('address', 255)->nullable();
            $table->string('postal_code', 255)->nullable();
            $table->string('city', 255)->nullable();
            $table->string('country', 255)->nullable();

            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('delivery_addresses');
    }
}
