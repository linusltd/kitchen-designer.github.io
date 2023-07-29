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
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->string('color', 255)->nullable();
            $table->text('image')->nullable();
            $table->text('url')->nullable();
            $table->integer('type')->comment('0=Home, 1=Shop, 2=English')->default(0);
            $table->integer('book_id')->nullable()->default(0);
            $table->integer('category_id')->nullable()->default(0);
            $table->integer('redirect')->comment('0=Book, 1=Category, 2=URL')->default(0);
            $table->integer('status')->comment('0=Active, 1=Inactive')->default(0);
            $table->softDeletes();
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
        Schema::dropIfExists('sliders');
    }
};
