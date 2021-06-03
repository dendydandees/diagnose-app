<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->text('images')->nullable();
            $table->text('slug')->unique();
            $table->string('title');
            $table->text('body');
            $table->enum('status', ['enabled', 'disabled'])->default('enabled');
            $table->json('keywords');
            $table->integer('viewcount')->default(0);
            $table->string('writer');
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
        Schema::dropIfExists('articles');
    }
}
