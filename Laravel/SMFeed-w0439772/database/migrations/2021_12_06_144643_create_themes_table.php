<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThemesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('themes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable(false);
            $table->string('cdn_url')->nullable(false);
            $table->unsignedBigInteger('created_by')->nullable(false);
            $table->foreign('created_by')
                ->references('id')
                ->on('users');
            $table->unsignedBigInteger('deleted_by')->nullable(true);
            $table->foreign('deleted_by')
                ->references('id')
                ->on('users');
            $table->unsignedBigInteger('updated_by')->nullable(true);
            $table->foreign('updated_by')
                ->references('id')
                ->on('users');
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
        Schema::dropIfExists('themes');
    }
}
