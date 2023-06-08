<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('invoice', function (Blueprint $table) {

            $table->id();
            $table->string('clientName');
            $table->string('clientAdd');
            $table->date('date');
            $table->decimal('total', 8, 2);
            $table->decimal('grandTotal', 8, 2);
            $table->decimal('price', 8, 2);
            $table->string('quantity');
            $table->string('remark');
            $table->string('status');
            $table->unsignedBigInteger('userID');
            $table->foreign('userID')->references('id')->on('users');
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
        Schema::dropIfExists('invoice');
    }
}
