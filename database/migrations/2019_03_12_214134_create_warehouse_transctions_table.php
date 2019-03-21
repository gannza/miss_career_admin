<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWarehouseTransctionsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warehouse_transctions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('currenty_qty');
            $table->string('action');
            $table->integer('added_qty');
            $table->string('messages');
            $table->unsignedInteger('model_id')->nullable();
            $table->foreign('model_id')->references('id')->on('models')
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
        Schema::drop('warehouse_transctions');
    }
}
