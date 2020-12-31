<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('document')->unique();
            $table->string('phone')->nullable();
            $table->string('fix_phone')->nullable();
            $table->string('nationality')->default('BR');
            $table->string('birth_date');
            $table->string('address');
            $table->integer('number');
            $table->string('city');
            $table->string('neighbourhood');
            $table->string('state')->default('RS');
            $table->string('zipcode');
            $table->string('id_customer_asaas');
            $table->enum('status', ['S', 'N'])->default('S');
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
        Schema::dropIfExists('clients');
    }
}
