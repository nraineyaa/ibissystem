<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id(); 
            $table->date('issueDate');
            $table->date('dueDate');
            $table->string('payment');
            $table->string('remark');
            $table->string('status');
            $table->string('invoiceNumber');
            $table->decimal('totalAmount', 8, 2);
            $table->unsignedBigInteger('userID');
            $table->unsignedBigInteger('compID');
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
        Schema::dropIfExists('invoices');
    }
}
