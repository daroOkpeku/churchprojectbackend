<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->tinyText('fullname')->nullable();
            $table->tinyText('email')->nullable();
            $table->tinyText('amount')->nullable();
            $table->tinyText('reason')->nullable();
            $table->tinyText('explain')->nullable();
            $table->tinyText('message')->nullable();
            $table->tinyText('referencecode')->nullable();
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
        Schema::dropIfExists('donations');
    }
};
