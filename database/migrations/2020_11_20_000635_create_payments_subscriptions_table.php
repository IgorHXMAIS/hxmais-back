<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('subscription_id');
            $table->string('payment_id_asaas')->nullable();
            $table->string('situation')->nullable();
            $table->date('due_date')->nullable();
            $table->date('payment_date')->nullable();
            $table->date('client_payment_date')->nullable();
            $table->string('invoice_url')->nullable();
            $table->string('invoice_number')->nullable();
            $table->string('authorization_code')->nullable();
            $table->enum('status', ['S', 'N'])->default('S');
            $table->timestamps();

            $table->foreign('subscription_id')->references('id')->on('subscriptions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments_subscriptions');
    }
}
