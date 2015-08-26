<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOpinionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opinions', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('external_id');
            $table->integer('project_id');
            $table->integer('donated_amount_in_cents');
            $table->string('score');
            $table->string('author')->nullable();
            $table->text('message')->nullable();
            $table->timestamp('donated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('opinions');
    }
}
