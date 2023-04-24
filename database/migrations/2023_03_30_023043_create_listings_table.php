<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->double('price');
            $table->string('tags');
            // $table->string('platforms');
            $table->string('banner')->nullable();
            $table->string('background')->nullable();
            $table->longText('description');


            $table->unsignedBigInteger('plat_id');
            $table->foreign('plat_id')->references('id')->on('platforms')->onDelete('cascade');

            $table->foreignId('user_id')->constrained()->onDelete('cascade');   // cascade remove all belonged list when delete
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
        Schema::dropIfExists('listings');
    }
};
