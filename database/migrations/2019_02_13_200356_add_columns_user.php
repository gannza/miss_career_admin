<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', [0, 1,2])->default(0);
            $table->string('phone');
            $table->enum('gender', ['M','F'])->default('M');
            $table->integer('branch_id')->nullable()->unsigned();
            $table->foreign('branch_id')->references('id')->on('branches')
                ->onUpdate('cascade')->onDelete('cascade');
            //1 is branch manage
            //2 is tail

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
