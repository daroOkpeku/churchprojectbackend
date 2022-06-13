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

        Schema::create('event_contents', function (Blueprint $table) {
            $table->id();
            $table->tinyText('titleevent')->nullable();
            $table->tinyText('imgone')->nullable();
            $table->tinyText('imgtwo')->nullable();
            $table->tinyText('eventdetailone')->nullable();
            $table->tinyText('eventdetailtwo')->nullable();
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
        Schema::dropIfExists('event_contents');
    }
};
