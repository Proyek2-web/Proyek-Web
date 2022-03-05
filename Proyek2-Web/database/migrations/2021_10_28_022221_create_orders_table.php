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
            $table->string('nama')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('custom')->nullable();
            $table->string('email')->nullable();
            $table->string('resi')->nullable();
            $table->string('kabupaten_kota');
            $table->string('provinsi');
            $table->string('alamat')->nullable();
            $table->string('zip_code');
            $table->string('reference')->nullable();
            $table->string('merchant_ref')->nullable();
            $table->integer('amount')->nullable();
            $table->enum('status', ['PAID', 'UNPAID'])->default('UNPAID')->nullable();
            $table->integer('quantity')->nullable();
            $table->foreignId('user_id');
            $table->integer('total_produk');
            $table->integer('total_ongkir');
            $table->string('order_notes');
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