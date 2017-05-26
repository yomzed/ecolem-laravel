<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRobotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('robots', function (Blueprint $table) {
            
            $table->increments('id');
            $table->string('name', 100);
            $table->string('slug', 100)->default('');
            $table->text('description')->nullable();
            $table->string('link', 100)->default('');
            $table->dateTime('published_at')->nullable();
            $table->enum('status', ['published', 'unpublished', 'draft'])->default('unpublished');
            $table->unsignedInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('SET NULL');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('robots');
    }
}
