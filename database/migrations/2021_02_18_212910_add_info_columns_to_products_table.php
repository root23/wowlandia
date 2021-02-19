<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInfoColumnsToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('tag');
            $table->double('delivery_width');
            $table->double('delivery_height');
            $table->double('delivery_depth');
            $table->double('delivery_weight');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('tag');
            $table->dropColumn('delivery_width');
            $table->dropColumn('delivery_height');
            $table->dropColumn('delivery_depth');
            $table->dropColumn('delivery_weight');
        });
    }
}
