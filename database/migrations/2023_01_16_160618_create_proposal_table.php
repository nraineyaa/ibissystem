<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProposalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proposal', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('userID');
            $table->string('proposalName');
            $table->string('proposalLocation');
            $table->date('proposalDate');
            $table->double('proposalBudget');
            $table->bigInteger('proposalPax');
            $table->string('proposalParticipant');
            $table->string('proposalDoc');
            $table->string('proposalStatus');
            $table->string('proposalComment');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proposal');
    }
}
