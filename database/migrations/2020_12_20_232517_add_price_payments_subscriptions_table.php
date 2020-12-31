<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPricePaymentsSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payments_subscriptions', function (Blueprint $table) {
            $table->double('price')->nullable()->after('payment_id_asaas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payments_subscriptions', function (Blueprint $table) {
            $table->dropColumn('price');
        });
    }
}
