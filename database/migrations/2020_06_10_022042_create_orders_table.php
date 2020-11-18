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
            $table->unsignedBigInteger('representative_id')->references('id')->on('representatives')->nullable();
            $table->string('church')->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('document')->unique();
            $table->string('phone');
            $table->string('nationality')->default('BR');
            $table->string('birth_date');
            $table->enum('type', ['billet', 'card'])->default('card');
            $table->json('address');
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
