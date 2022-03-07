<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');

            $table->unsignedBigInteger('deleted_by')->nullable(true);
            $table->foreign('deleted_by')
                ->references('id')
                ->on('users');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
//            $table->dateTime('created_at');
//            $table->dateTime('updated_at');
            $table->dateTime('deleted_at')->nullable(true);
            $table->timestamps();
        });
        //Schema::table('users');
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
