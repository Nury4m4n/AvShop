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
            $table->uuid('id')->primary();
            $table->unsignedBigInteger('user_id');
            $table->string('orderer_name');
            $table->string('orderer_email');
            $table->string('orderer_phone');
            $table->text('orderer_address');
            $table->decimal('total_amount', 65, 2);
            $table->enum('status', ['pending', 'Paid', 'failed'])->default('pending');
            $table->string('resi_number')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('payment_channel')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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