<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComPerfilsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('com_perfils', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('cpf', 11)->nullable();
            $table->date('data_nasc')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->decimal('credit', 10, 2);
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
        Schema::dropIfExists('com_perfils');
    }
}
