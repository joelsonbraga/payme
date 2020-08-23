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
            $table->integer('origin');
            $table->integer('destiny');
            $table->enum('type', ['credit', 'debit'])->nullable();
            $table->enum('status',['pending', 'success', 'error'])->default('pending');
            $table->double('value');

            $table->index('origin');
            $table->index('destiny');
            $table->index('type');
            $table->index('status');

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
