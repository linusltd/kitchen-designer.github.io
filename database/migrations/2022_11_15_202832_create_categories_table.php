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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable();
            $table->string('slug', 255)->nullable();
            $table->string('color', 255)->nullable();
            $table->text('image')->nullable();
            $table->integer('parent_id')->default(0);
            $table->integer('level')->default(0);
            $table->integer('show_top')->comment('0=Not Show, 1=Show')->default(0);
            $table->integer('status')->comment('0=Active, 1=Inactive')->default(0);
            $table->softDeletes();
            $table->unique(['name', 'slug', 'parent_id', 'deleted_at']);
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
        Schema::dropIfExists('categories');
    }
};
