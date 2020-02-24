<?php

use Illuminate\Support\Facades\Schema;
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
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('logo');
            $table->json('media');
            $table->string('title');
            $table->text('body');
            $table->json('article_media');
            $table->string('article_title');
            $table->text('article_body');
            $table->text('service_body');  
            $table->unsignedBigInteger('user_id');
            $table->unsignedInteger('status')->default(0);
            $table->boolean('show_link')->default(0);
            $table->text('message');
            $table->string('lang');
            $table->datetime('ends_at')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
