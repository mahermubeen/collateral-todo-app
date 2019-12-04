<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable()->default('');
            $table->unsignedBigInteger('member_id');
            $table->unsignedBigInteger('status_id');
            $table->string('due_date')->nullable()->default('');
            $table->string('time_tracking')->nullable()->default('');
            $table->timestamps();

            $table->foreign('member_id')
                ->references('id')->on('members')->onDelete('cascade');
            $table->foreign('status_id')
                ->references('id')->on('statuses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
