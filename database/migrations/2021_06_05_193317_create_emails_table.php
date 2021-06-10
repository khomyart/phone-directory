<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emails', function (Blueprint $table) {
            $table->id();
            $table->string('email', 55);
            $table->unsignedBigInteger('executive_authority_id');
            $table->integer('number_in_list');
            $table->enum('is_main',['yes', 'no']);
            $table->timestamps();

            $table->foreign('executive_authority_id')
                ->references('id')
                ->on('executive_authorities')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('emails');
    }
}
