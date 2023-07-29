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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->morphs('orderable');
            $table->string('order_no', 255)->nullable();
            $table->string('reference_no', 255)->nullable();
            $table->string('issue_date', 255)->nullable();
            $table->string('delivery_date', 255)->nullable();
            $table->integer('qty')->default(0);
            $table->decimal('total_amount', 8,2)->default(0);
            $table->decimal('sub_total', 8,2)->default(0);
            $table->decimal('delivery_charges', 8,2)->default(0);
            $table->integer('type')->comment('0=Sale, 1=Purchase')->default(0);
            $table->integer('status')->comment('0=Open/Pending, 1=Completed/Delivered, 2=Cancelled/Returend, 3=Shipped, 4=Cancel Request, 5=Failed Delivery')->default(0);
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
        Schema::dropIfExists('orders');
    }
};
