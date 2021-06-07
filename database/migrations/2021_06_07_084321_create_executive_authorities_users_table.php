<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExecutiveAuthoritiesUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('executive_authorities_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('executive_authority_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();

            $table->foreign('executive_authority_id')
                  ->references('id')
                  ->on('executive_authorities');

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('executive_authorities_users');
    }
}
