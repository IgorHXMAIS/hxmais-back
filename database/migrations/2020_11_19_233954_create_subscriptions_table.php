<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('client_id');
            $table->integer('id_subscription_asaas');
            $table->date('date_created');
            $table->date('next_due_date');
            $table->string('status_subscription');
            $table->double('price');
            $table->enum('cycle', ['weekly', 'monthly', 'quarterly', 'yearly'])->default('monthly');
            $table->enum('billing_type', ['billet', 'card'])->default('billet');
            $table->string('holder_name_card')->nullable();
            $table->string('first_digits_number_card')->nullable();
            $table->string('last_digits_number_card')->nullable();
            $table->string('month_expiry_card')->nullable();
            $table->string('year_expiry_card')->nullable();
            $table->string('documment_card')->nullable();
            $table->enum('status', ['S', 'N'])->default('S');
            $table->ipAddress('ip');
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('client_id')->references('id')->on('clients');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscriptions');
    }
}
