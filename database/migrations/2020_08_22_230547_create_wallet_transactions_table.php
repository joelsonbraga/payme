<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallet_transactions', function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->unique();
            $table->uuid('uuid')->unique();
            $table->integer('payer');
            $table->integer('payee');
            $table->enum('type', ['credit', 'debit'])->nullable();
            $table->double('value');

            $table->index('payer');
            $table->index('payee');
            $table->index('type');

            $table->foreign('payer')->references('id')->on('persons');
            $table->foreign('payee')->references('id')->on('persons');

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
        Schema::dropIfExists('wallet_transactions');
    }
}
