<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSalesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id');
            $table->date('invoice_date');
            $table->date('payment_date');
            $table->decimal('total_amount')->default(0.00);
            $table->decimal('amount_due')->default(0.00);;
            $table->decimal('tax_rate')->default(0.00);
            $table->string('currency')->default('Rwf');
            $table->integer('customer_id');
            $table->integer('branch_id');
            $table->integer('operator_id');
            $table->string('payment_method');
            $table->string('payment_status');
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
        Schema::drop('sales');
    }
}
