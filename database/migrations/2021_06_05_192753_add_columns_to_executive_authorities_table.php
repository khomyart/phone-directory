<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToExecutiveAuthoritiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('executive_authorities', function (Blueprint $table) {
            $table->string('identifier_code', 30);
            $table->string('location_description', 500)->nullable();
            $table->string('location_coordinates', 15)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('executive_authorities', function (Blueprint $table) {
            //
        });
    }
}
