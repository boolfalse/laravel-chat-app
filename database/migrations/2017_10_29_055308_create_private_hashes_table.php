<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrivateHashesTable extends Migration
{
    public function up()
    {
        Schema::create('private_hashes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned(); // foreign key
            $table->integer('room_id')->unsigned(); // foreign key

            $table->string('hash', 60);

            $table->timestamps();

            $table->foreign('room_id')
                ->references('id')
                ->on('rooms')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('private_hashes');
    }
}
