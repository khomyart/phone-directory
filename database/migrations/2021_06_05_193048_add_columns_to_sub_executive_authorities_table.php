<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToSubExecutiveAuthoritiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sub_executive_authorities', function (Blueprint $table) {
            $table->string('location_description', 500);
            $table->string('location_coordinates', 15);

            $table->foreign('executive_authority_id')
                ->references('id')
                ->on('executive_authorities')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sub_executive_authorities', function (Blueprint $table) {
            //
        });
    }
}
