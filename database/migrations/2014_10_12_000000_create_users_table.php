<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('cafename')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('role');
            $table->string('status')->default('useable');
            $table->integer('balance')->default('0');
            $table->longText('tojson')->nullable();
            $table->longText('tojson2')->nullable();
            $table->longText('tojson3')->nullable();
            $table->longText('tojson4')->nullable();
            $table->longText('tojson5')->nullable();
            $table->longText('tojson6')->nullable();
            $table->longText('tojson7')->nullable();
            $table->longText('tojson8')->nullable();
            $table->longText('tojson9')->nullable();
            $table->longText('tojson10')->nullable();
            $table->longText('tojson11')->nullable();
            $table->longText('tojson12')->nullable();
            $table->longText('tojson13')->nullable();
            $table->longText('tojson14')->nullable();
            $table->longText('tojson15')->nullable();
            $table->longText('tojson16')->nullable();
            $table->longText('tojson17')->nullable();
            $table->longText('tojson18')->nullable();
            $table->longText('tojson19')->nullable();
            $table->longText('tojson20')->nullable();
            $table->longText('tojson21')->nullable();
            $table->longText('tojson22')->nullable();
            $table->longText('tojson23')->nullable();
            $table->longText('tojson24')->nullable();

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
