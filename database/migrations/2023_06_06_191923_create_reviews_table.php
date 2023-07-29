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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_id')->constrained();
            $table->integer('user_id')->default(0);
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('ratings')->nullable();
            $table->longText('review')->nullable();
            $table->integer('is_verified')->comment('0=Not Verified, 1=Verified, 2=Rejected')->default(0);
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
        Schema::dropIfExists('reviews');
    }
};
