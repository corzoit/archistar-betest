<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyAnalyticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_analytics', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('property_id')->unsigned();
            $table->bigInteger('analytic_type_id')->unsigned();
            $table->float('value')->nullable();

            $table->unique(['property_id', 'analytic_type_id']);

            $table->foreign('property_id')->references('id')->on('properties');
            $table->foreign('analytic_type_id')->references('id')->on('analytic_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('property_analytics');
    }
}
