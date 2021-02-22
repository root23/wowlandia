<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('username');
            $table->string('phone');
            $table->string('email');
            $table->string('zip_code');
            $table->string('city_name');
            $table->string('address');
            $table->double('total');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('username');
            $table->dropColumn('phone');
            $table->dropColumn('email');
            $table->dropColumn('zip_code');
            $table->dropColumn('city_name');
            $table->dropColumn('address');
            $table->dropColumn('total');
        });
    }
}
