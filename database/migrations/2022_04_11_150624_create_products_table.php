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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('model_id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('license')->nullable();
            $table->string('license_plate')->nullable();
            $table->timestamp('examination_date')->nullable();
            $table->double('credit_amount')->nullable();
            $table->double('price')->nullable();
            $table->integer('using_status')->nullable();
            $table->integer('status')->nullable();
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
        Schema::dropIfExists('products');
    }
};
