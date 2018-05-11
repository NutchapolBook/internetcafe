<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInternetcafesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('internetcafes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('colour')->nullable();
            $table->integer('price')->default(12);
            $table->string('location')->nullable();
            $table->string('tel')->nullable();
            $table->string('facebook')->nullable();
            $table->string('line')->nullable();
            $table->string('picture1')->nullable();
            $table->string('picture2')->nullable();
            $table->string('picture3')->nullable();
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
        Schema::dropIfExists('internetcafes');
    }
}
