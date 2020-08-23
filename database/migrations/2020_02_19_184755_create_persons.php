<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersons extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persons', function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->unique();
            $table->uuid('uuid')->unique();
            $table->enum('type', [
                'master',
                'common',
                'shopkeeper',
            ])->nullable();
            $table->enum('type_document',['cpf', 'cnpj'])->default('other');
            $table->string('document', 30)->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('cellphone', 30)->unique();

            $table->index('type');
            $table->index('type_document');
            $table->index('email');
            $table->index('document');

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
        Schema::dropIfExists('persons');
    }
}
