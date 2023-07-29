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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable();
            $table->string('slug', 255)->nullable();
            $table->integer('pages')->default(0);
            $table->string('binding', 255)->nullable();
            $table->integer('volume')->default(0);
            $table->string('size')->nullable();
            $table->longText('description', 255)->nullable();
            $table->integer('price')->default(0);
            $table->integer('special_price')->nullable()->default(0);
            $table->integer('quantity')->default(0);
            $table->decimal('low_stock_min', 8, 2)->default(0);
            $table->string('sku', 255)->nullable()->default('');
            $table->integer('status')->comment('0=pending, 1=online, 2=draft, 3=oos, 4=inactive, 5=suspended, 6=deleted');
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
        Schema::dropIfExists('books');
    }
};
