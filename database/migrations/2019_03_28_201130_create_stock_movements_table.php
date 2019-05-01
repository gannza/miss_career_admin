<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatestockMovementsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_movements', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('currenty_qty');
            $table->string('action');
            $table->string('reason');
            $table->integer('added_qty')->default(0);
            $table->integer('removed_qty')->default(0);
            $table->integer('transfered_qty')->default(0);
            $table->string('messages');
            $table->unsignedInteger('model_id')->nullable();
            $table->foreign('model_id')->references('id')->on('models')
                ->onUpdate('cascade')->onDelete('cascade');
                $table->unsignedInteger('branch_id')->nullable();
                $table->foreign('branch_id')->references('id')->on('branches')
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
        Schema::drop('stock_movements');
    }
}