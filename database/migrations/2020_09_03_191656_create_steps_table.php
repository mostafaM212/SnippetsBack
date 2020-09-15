<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStepsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('steps', function (Blueprint $table) {
            $table->id();
            $table->integer('snippet_id')->unsigned()->index();
            $table->uuid('uuid');
            $table->string('title')->nullable();
            $table->longText('body')->nullable();
            $table->integer('order')->unsigned()->index() ;
            $table->timestamps();

            $table->foreign('snippet_id')->references('id')->on('snippets')
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
        Schema::dropIfExists('steps');
    }
}
