<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommissionsRepresentativesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commissions_representatives', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('payment_subscription_id');
            $table->unsignedBigInteger('representative_id');
            $table->enum('type_commission_representative', ['value', 'percentage'])->default('percentage');
            $table->string('commission_representative');
            $table->double('price');
            $table->string('situation');
            $table->enum('status', ['S', 'N'])->default('S');
            $table->timestamps();

            $table->foreign('payment_subscription_id')->references('id')->on('payments_subscriptions');
            $table->foreign('representative_id')->references('id')->on('representatives');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commissions_representatives');
    }
}
