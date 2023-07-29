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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->string('currency')->nullable()->default('PKR');
            $table->string('token')->nullable();
            $table->integer('item_count')->default(0);
            $table->decimal('items_subtotal_price')->default(0);
            $table->decimal('original_total_price')->default(0);
            $table->decimal('total_discount')->default(0);
            $table->decimal('total_price')->default(0);
            $table->decimal('total_weight')->default(0);
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
        Schema::dropIfExists('carts');
    }
};
