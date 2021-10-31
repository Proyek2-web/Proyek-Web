<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('phone_number');
            $table->string('custom');
            $table->string('email');
            $table->foreignId('product_id');
            $table->foreignId('category_id');
            $table->string('reference')->nullable();
            $table->string('merchant_ref')->nullable();
            $table->integer('amount')->nullable();
            $table->enum('status', ['PAID', 'UNPAID'])->default('UNPAID');
            $table->integer('quantity');
            $table->foreignId('delivery_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}