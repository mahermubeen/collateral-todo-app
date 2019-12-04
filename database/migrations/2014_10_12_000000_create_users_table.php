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
            $table->bigIncrements('id');
            $table->string('fname')->nullable()->default('');
            $table->string('lname')->nullable()->default('');
            $table->string('name')->nullable()->default('');
            $table->string('email')->nullable()->default('');
            $table->string('password')->nullable()->default('');
            $table->string('status')->default(1);
            $table->string('avatar')->default('default.png');
            $table->string('google_id')->default(1);
            $table->string('avatar_original')->nullable();
            $table->timestamp('email_verified_at')->nullable();
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
