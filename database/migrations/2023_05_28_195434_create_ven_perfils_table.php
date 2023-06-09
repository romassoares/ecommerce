<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVenPerfilsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ven_perfils', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->decimal('credit', 10, 2)->nullable();
            $table->enum('status', ['apr', 'pen', 'rej'])->default('pen');
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
        Schema::dropIfExists('ven_perfils');
    }
}
