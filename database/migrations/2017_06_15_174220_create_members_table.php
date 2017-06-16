<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
              $table->increments('id');
              $table->string('name')->unique();
              $table->string('email')->unique();
              $table->string('password');
              $table->string('blood');
              $table->string('birthyear');
              $table->string('phone');
              $table->string('province');
              $table->integer('countdonate');
              $table->string('img');
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
        Schema::dropIfExists('members');
    }
}