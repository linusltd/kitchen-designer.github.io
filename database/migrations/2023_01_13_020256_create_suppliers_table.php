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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable();
            $table->string('contact_person', 255)->nullable();
            $table->text('address', 255)->nullable();
            $table->string('city', 255)->nullable();
            $table->string('mobile', 255)->nullable();
            $table->string('phone', 255)->nullable();
            $table->integer('opening_balance')->default(0);
            $table->string('opening_date')->nullable();
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
        Schema::dropIfExists('suppliers');
    }
};
