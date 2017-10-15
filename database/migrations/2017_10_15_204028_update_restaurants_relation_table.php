<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateRestaurantsRelationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('opening_times', function (Blueprint $table) {
            $table->dropForeign(['restaurant_id']);
            $table->foreign('restaurant_id')->references('id')->on('restaurants')->onDelete('cascade');
        });

        Schema::table('pictures', function (Blueprint $table) {
            $table->dropForeign(['restaurant_id']);
            $table->foreign('restaurant_id')->references('id')->on('restaurants')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('opening_times', function (Blueprint $table) {
            $table->dropForeign(['restaurant_id']);
            $table->foreign('restaurant_id')->references('id')->on('restaurants');
        });

        Schema::table('pictures', function (Blueprint $table) {
            $table->dropForeign(['restaurant_id']);
            $table->foreign('restaurant_id')->references('id')->on('restaurants');
        });
    }
}
