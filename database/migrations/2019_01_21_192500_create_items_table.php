<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateItemsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('cost_price');
            $table->integer('sale_price');
            $table->string('barcode')->nullable();
            $table->string('description')->nullable();
            $table->unsignedInteger('model_id')->nullable();
            $table->foreign('model_id')->references('id')->on('models')
                ->onUpdate('cascade')->onDelete('cascade');
                $table->unsignedInteger('brand_id')->nullable();
                $table->foreign('brand_id')->references('id')->on('brands')
                    ->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('items');
    }
}
