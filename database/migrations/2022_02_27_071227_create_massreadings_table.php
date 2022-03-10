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
        Schema::create('massreadings', function (Blueprint $table) {
            $table->id();
            $table->tinyText('firstheading')->nullable();
            $table->longText('firstbody')->nullable();
            $table->tinyText('responsorialheading')->nullable();
            $table->tinyText('responsorialresponse')->nullable();
            $table->longText('responsorialbody')->nullable();
            $table->tinyText('secondheading')->nullable();
            $table->longText('secondbody')->nullable();
            $table->tinyText('alleluiaheading')->nullable();
            $table->longText('alleluiabody')->nullable();
            $table->tinyText('gospelheading')->nullable();
             $table->longText('gospelbody')->nullable();
             $table->date('dailydate')->nullable();
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
        Schema::dropIfExists('massreadings');
    }
};
