<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('external_id');
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('title');
            $table->string('description');
            $table->boolean('tax_deductible');
            $table->boolean('donations_prohibited');
            $table->timestamp('completed_at')->nullable();
            $table->integer('open_amount_in_cents');
            $table->integer('positive_opinions_count');
            $table->integer('negative_opinions_count');
            $table->integer('donor_count');
            $table->integer('progress_percentage');
            $table->integer('incomplete_need_count');
            $table->integer('completed_need_count');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('projects');
    }
}
