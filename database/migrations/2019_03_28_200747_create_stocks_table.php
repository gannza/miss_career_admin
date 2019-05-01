<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStocksTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('total_entered_qty');
            $table->integer('qty');
            $table->integer('added_qty');
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
        Schema::drop('stocks');
    }
}
