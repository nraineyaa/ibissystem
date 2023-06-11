<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClaimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('claims', function (Blueprint $table) {
            $table->id();
            $table->string('claimType');
            $table->date('date');
            $table->decimal('amount', 8, 2);
            $table->string('svName');
            $table->string('status');
            $table->string('remark')->nullable();
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
        Schema::dropIfExists('claims');
    }
}
