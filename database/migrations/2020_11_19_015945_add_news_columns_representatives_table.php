<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewsColumnsRepresentativesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('representatives', function (Blueprint $table) {
            $table->enum('type_commision', ['value', 'percentage'])->default('percentage');
            $table->double('value')->nullable();
            $table->integer('percentage')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('representatives', function (Blueprint $table) {
            $table->dropColumn('type_commision');
            $table->dropColumn('value');
            $table->dropColumn('percentage');
        });
    }
}
