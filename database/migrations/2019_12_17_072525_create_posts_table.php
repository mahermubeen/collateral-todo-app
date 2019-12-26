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
            $table->unsignedBigInteger('task_id')->nullable();
            $table->unsignedBigInteger('member_id')->nullable();
            $table->unsignedBigInteger('status_id')->nullable();
            $table->string('due_date')->nullable()->default('');
            $table->string('time_tracking')->nullable()->default('');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->timestamps();

            $table->foreign('member_id')
                ->references('id')->on('members')->onDelete('cascade');
            $table->foreign('status_id')
                ->references('id')->on('statuses')->onDelete('cascade');
            $table->foreign('task_id')
                ->references('id')->on('tasks')->onDelete('cascade');
            $table->foreign('category_id')
                ->references('id')->on('categories')->onDelete('cascade');
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
