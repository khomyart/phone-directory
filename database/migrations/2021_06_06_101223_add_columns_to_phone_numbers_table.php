<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToPhoneNumbersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('phone_numbers', function (Blueprint $table) {
            $table->unsignedBigInteger('sub_executive_authority_id')->nullable();
            $table->unsignedBigInteger('executive_authority_id')->nullable();

            $table->foreign('sub_executive_authority_id')
                ->references('id')
                ->on('sub_executive_authorities')
                ->onDelete('cascade')
                ->onUpdate('cascade');

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
        Schema::table('phone_numbers', function (Blueprint $table) {

        });
    }
}
