<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->string('title')->nullable(false);
            $table->text('content')->nullable(false);

            $table->unsignedBigInteger('created_by')->nullable(false);
            $table->unsignedBigInteger('deleted_by')->nullable(true);
            $table->foreign('created_by')
                ->references('id')
                ->on('users');
            $table->foreign('deleted_by')
                ->references('id')
                ->on('users');
//            $table->dateTime('created_at');
//            $table->dateTime('updated_at');
            $table->dateTime('deleted_at')->nullable(true);
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
        Schema::dropIfExists('posts');
    }
}
