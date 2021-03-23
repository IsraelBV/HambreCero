<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableCPeriodosEntrega extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('c_periodosdeentrega', function (Blueprint $table) {
            $table->id();
            $table->string('Descripcion')->nullable();
            $table->boolean('status')->nullable();
            $table->integer('idPeriodo')->nullable();
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
        Schema::dropIfExists('c_periodosdeentrega');
    }
}
