<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company', function (Blueprint $table) {
                $table->id();
                $table->string('compName');
                $table->string('compPhone');
                $table->string('compEmail');
                $table->string('address');
                $table->unsignedBigInteger('invoiceID');
                $table->unsignedBigInteger('userID');
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
        Schema::dropIfExists('company');
    }
}
